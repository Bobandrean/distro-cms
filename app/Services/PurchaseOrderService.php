<?php

namespace App\Services;

use App\Repositories\PurchaseOrderRepository;

class PurchaseOrderService
{
    /**
     * @var PurchaseOrderRepository
     */
    private $purchaseOrderRepository;

    /**
     * PurchaseOrderService constructor.
     * @param PurchaseOrderRepository $purchaseOrderRepository
     */

    public function __construct(PurchaseOrderRepository $purchaseOrderRepository)
    {
        $this->purchaseOrderRepository = $purchaseOrderRepository;
    }

    public function all()
    {
        return $this->purchaseOrderRepository->all();
    }

    public function datatable($request)
    {
        return $this->purchaseOrderRepository->datatable($request);
    }

    public function datatableByCustomerId($customer_id)
    {
        return $this->purchaseOrderRepository->datatableByCustomerId($customer_id);
    }

    public function getById($id)
    {
        return $this->purchaseOrderRepository->getById($id);
    }

    public function getByIdWith($id)
    {
        return $this->purchaseOrderRepository->getByIdWith($id, ['pemasok', 'pembeli','tipe_pembayaran','tipe_pengiriman','po_billing','po_detail','po_barang.produk']);
    }

    public function store($data)
    {
        return $this->purchaseOrderRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->purchaseOrderRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->purchaseOrderRepository->destroy($id);
    }

    public function topCustomers($request)
    {
        return $this->purchaseOrderRepository->topCustomers($request);
    }

    public function totalOrders($request)
    {
        return $this->purchaseOrderRepository->totalOrders($request);
    }

    public function totalFinanced($request)
    {
        return $this->purchaseOrderRepository->subtotalGtv($request) + $this->purchaseOrderRepository->subtotalDisbursement($request);
    }

    public function totalLoanRepaid($request)
    {
        return $this->purchaseOrderRepository->totalLoanRepaid($request);
    }

    public function totalLoanRepaidThisMonth($request)
    {
        return $this->purchaseOrderRepository->totalLoanRepaidThisMonth($request);
    }

    public function totalOutstanding($request)
    {
        return $this->purchaseOrderRepository->totalOutstanding($request);
    }

    public function ongoingTransaction($request)
    {
        return $this->purchaseOrderRepository->ongoingTransaction($request);
    }

    public function newOrders($request)
    {
        return $this->purchaseOrderRepository->newOrders($request);
    }

    public function subtotalDisbursement($request)
    {
        return $this->purchaseOrderRepository->subtotalDisbursement($request);
    }

    public function subtotalUndisbursement($request)
    {
        return $this->purchaseOrderRepository->subtotalUndisbursement($request);
    }

    public function numberOfOrders($request)
    {
        return $this->purchaseOrderRepository->numberOfOrders($request);
    }

    public function outstandings($request)
    {
        return $this->purchaseOrderRepository->outstandings($request);
    }

    public function undisbursements($request)
    {
        return $this->purchaseOrderRepository->undisbursements($request);
    }

    public function disbursementDatatable($request)
    {
        return $this->purchaseOrderRepository->disbursementDatatable($request);
    }

    public function pendingDisbursementDatatable($request)
    {
        return $this->purchaseOrderRepository->pendingDisbursementDatatable($request);
    }

    public function exportDisbursementDatatable($request)
    {
        return $this->purchaseOrderRepository->exportDisbursementDatatable($request);
    }

    public function exportPendingDisbursementDatatable($request)
    {
        return $this->purchaseOrderRepository->exportPendingDisbursementDatatable($request);
    }

    public function totalOrdersDatatable($request)
    {
        return $this->purchaseOrderRepository->totalOrdersDatatable($request);
    }

    public function exportTotalOrdersDatatable($request)
    {
        return $this->purchaseOrderRepository->exportTotalOrdersDatatable($request);
    }

    public function financedDatatable($request)
    {
        return $this->purchaseOrderRepository->financedDatatable($request);
    }

    public function exportFinancedDatatable($request)
    {
        return $this->purchaseOrderRepository->exportFinancedDatatable($request);
    }

    public function totalLoanRepaidDatatable($request)
    {
        return $this->purchaseOrderRepository->totalLoanRepaidDatatable($request);
    }

    public function exportTotalLoanRepaidDatatable($request)
    {
        return $this->purchaseOrderRepository->exportTotalLoanRepaidDatatable($request);
    }

    public function totalLoanRepaidThisMonthDatatable($request)
    {
        return $this->purchaseOrderRepository->totalLoanRepaidThisMonthDatatable($request);
    }

    public function exportTotalLoanRepaidThisMonthDatatable($request)
    {
        return $this->purchaseOrderRepository->exportTotalLoanRepaidThisMonthDatatable($request);
    }

    public function totalOutstandingDatatable($request)
    {
        return $this->purchaseOrderRepository->totalOutstandingDatatable($request);
    }

    public function exportTotalOutstandingDatatable($request)
    {
        return $this->purchaseOrderRepository->exportTotalOutstandingDatatable($request);
    }

    public function ongoingTransactionDatatable($request)
    {
        return $this->purchaseOrderRepository->ongoingTransactionDatatable($request);
    }

    public function ActiveCustomerDatatable($request)
    {
        return $this->purchaseOrderRepository->ActiveCustomerDatatable($request);
    }

    public function ActiveSupplierDatatable($request)
    {
        return $this->purchaseOrderRepository->ActiveSupplierDatatable($request);
    }

    public function exportOngoingTransactionDatatable($request)
    {
        return $this->purchaseOrderRepository->exportOngoingTransactionDatatable($request);
    }

    public function newOrdersDatatable($request)
    {
        return $this->purchaseOrderRepository->newOrdersDatatable($request);
    }

    public function exportNewOrdersDatatable($request)
    {
        return $this->purchaseOrderRepository->exportNewOrdersDatatable($request);
    }

    public function agingDatatable($request)
    {
        return $this->purchaseOrderRepository->agingDatatable($request);
    }

    public function agingDetail($year, $month)
    {
        return $this->purchaseOrderRepository->agingDetail($year, $month);
    }

    public function export($request)
    {
        return $this->purchaseOrderRepository->export($request);
    }

    public function datatableFinancing($request)
    {
        return $this->purchaseOrderRepository->datatableFinancing($request);
    }

    public function getDataActiveCustomers()
    {
        return $this->purchaseOrderRepository->getDataActiveCustomers();
    }

    public function getDataActivePrincipal()
    {
        return $this->purchaseOrderRepository->getDataActivePrincipal();
    }

    public function exportActiveCustomerDatatable($request)
    {
        return $this->purchaseOrderRepository->exportActiveCustomerDatatable($request);
    }

    public function exportActiveSupplierDatatable($request)
    {
        return $this->purchaseOrderRepository->exportActiveSupplierDatatable($request);
    }
    public function totalOverDue($request)
    {
        return $this->purchaseOrderRepository->totalOverDue($request);
    }
    public function totalOverDueDatatable($request)
    {
        return $this->purchaseOrderRepository->totalOverDueDatatable($request);
    }
    public function totalBorrower($request)
    {
        return $this->purchaseOrderRepository->totalBorrower($request);
    }
    public function totalBorrowerDatatables($request)
    {
        return $this->purchaseOrderRepository->totalBorrowerDatatables($request);
    }
    public function PoDueDates($request)
    {
        return $this->purchaseOrderRepository->PoDueDates($request);
    }
    public function OutDatedPo($request)
    {
        return $this->purchaseOrderRepository->OutDatedPo($request);
    }
}
