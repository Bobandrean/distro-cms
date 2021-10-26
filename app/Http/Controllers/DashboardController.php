<?php

namespace App\Http\Controllers;

use Acaronlex\LaravelCalendar\Calendar;
use App\Services\CustomerService;
use App\Services\PaymentTypeCustomerService;
use App\Services\PurchaseOrderItemService;
use App\Services\PurchaseOrderService;
use App\Services\SupplierService;
use App\Services\PodueDates;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $request;
    private $purchaseOrderItemService;
    private $purchaseOrderService;
    private $supplierService;
    private $customerService;
    private $paymentTypeCustomerService;

    public function __construct(Request $request, PurchaseOrderItemService $purchaseOrderItemService,
                                PurchaseOrderService $purchaseOrderService, SupplierService $supplierService,
                                CustomerService $customerService, PaymentTypeCustomerService $paymentTypeCustomerService)
    {
        $this->request = $request;
        $this->purchaseOrderItemService = $purchaseOrderItemService;
        $this->purchaseOrderService = $purchaseOrderService;
        $this->supplierService = $supplierService;
        $this->customerService = $customerService;
        $this->paymentTypeCustomerService = $paymentTypeCustomerService;
    }

    public function index()
    {
        $request = $this->request;
        $topProductCategories = $this->purchaseOrderItemService->topProductCategories($this->request);
        $topProducts = $this->purchaseOrderItemService->topProducts($this->request);
        $topCustomers = $this->purchaseOrderService->topCustomers($this->request);
        $activeSuppliers = $this->supplierService->getNumber($this->request);
        $activeCustomers = $this->customerService->getNumber($this->request);
        $totalOrders = $this->purchaseOrderService->totalOrders($this->request);
        $totalFinanced = $this->purchaseOrderService->totalFinanced($this->request);
        $totalLoanRepaid = $this->purchaseOrderService->totalLoanRepaid($this->request);
        $totalOutstanding = $this->purchaseOrderService->totalOutstanding($this->request);
        $ongoingTransaction = $this->purchaseOrderService->ongoingTransaction($this->request);
        $getActiveCustomers = $this->purchaseOrderService->getDataActiveCustomers();
        $getActivePrincipal = $this->purchaseOrderService->getDataActivePrincipal();
        $totalGTV = $totalOrders + $totalFinanced + $totalLoanRepaid;
        $totalPlafon = $this->paymentTypeCustomerService->totalPlafon($this->request);
        $totalLoanRepaidThisMonth = $this->purchaseOrderService->totalLoanRepaidThisMonth($this->request);
        $newOrders = $this->purchaseOrderService->newOrders($this->request);
        $subtotalDisbursement = $this->purchaseOrderService->subtotalDisbursement($this->request);
        $subtotalUndisbursement = $this->purchaseOrderService->subtotalUndisbursement($this->request);
        $numberOfOrders = $this->purchaseOrderService->numberOfOrders($this->request);
        $totalOverDue = $this->purchaseOrderService->totalOverDue($this->request);
        $totalBorrower = $this->purchaseOrderService->totalBorrower($this->request);
        $poDueDates = $this->purchaseOrderService->PoDueDates($this->request);
        $outDatedPo = $this->purchaseOrderService->OutDatedPo($this->request);

        $calendar = $this->calendar();

        return view('contents.dashboard.index', compact(
            'request', 'topProductCategories', 'topProducts', 'topCustomers', 'activeSuppliers', 'activeCustomers',
            'totalOrders', 'totalFinanced', 'totalLoanRepaid', 'totalOutstanding', 'ongoingTransaction', 'getActiveCustomers', 'getActivePrincipal', 'totalGTV', 'totalPlafon', 'totalLoanRepaidThisMonth', 'newOrders', 'subtotalDisbursement', 'subtotalUndisbursement',
            'numberOfOrders','totalOverDue','totalBorrower','calendar','poDueDates','outDatedPo'
        ));
    }

    public function calendar()
    {
        $outstandings = $this->purchaseOrderService->outstandings($this->request);
        $undisbursements = $this->purchaseOrderService->undisbursements($this->request);

        $events = [];

        foreach($outstandings as $outstanding):
            $events[] = Calendar::event(
                "Repayment: " . $outstanding->kode_po . ' - ' . $outstanding->pembeli->nama_usaha . ' - ' . $outstanding->tipe_pembayaran->nama . ' (' . $outstanding->po_detail->lama_pinjaman . ' hari) - Rp' . number_format($outstanding->total, 2, '.', ','),
                true,
                new \DateTime($outstanding->po_detail->jatuh_tempo),
                new \DateTime($outstanding->po_detail->jatuh_tempo),
                $outstanding->kode_po
            );
        endforeach;

        foreach($undisbursements as $undisbursement):
            $events[] = Calendar::event(
                "Disbursement: " . $undisbursement->kode_po . ' - ' . $undisbursement->pembeli->nama_usaha . ' - ' . $undisbursement->tipe_pembayaran->nama . ' (' . $undisbursement->po_detail->lama_pinjaman . ' hari) - Rp' . number_format($undisbursement->subtotal, 2, '.', ','),
                true,
                new \DateTime($undisbursement->po_detail->tanggal_pencairan_pemasok),
                new \DateTime($undisbursement->po_detail->tanggal_pencairan_pemasok),
                $undisbursement->kode_po,
            );
        endforeach;

        $calendar = new Calendar();
        $calendar->addEvents($events)
            ->setOptions([
                'timeZone' => 'Asia/Jakarta',
                'themeSystem' => 'default',
                'locale' => 'en',
                'firstDay' => 0,
                'displayEventTime' => false,
                'selectable' => false,
                'initialView' => 'dayGridMonth',
                'headerToolbar' => [
                    'start' => 'title',
                    'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay listWeek'
                ],
                'height' => 600,
                'dayMaxEvents' => 3
            ]);
        $calendar->setId('1');
        $calendar->setCallbacks([
            'dateClick' => 'function(info){
                calendar.gotoDate(info.date);
                calendar.changeView("listWeek");
            }'
        ]);

        return $calendar;
    }
}
