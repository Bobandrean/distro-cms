<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BannerGratiaController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BuyerTypeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\PriceCatalogueController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\DeliveryOrderHistoryController;
use App\Http\Controllers\FinancingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NewCustomerController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\LogLoginController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AvailableCreditLineController;
use App\Http\Controllers\DisbursementController;
use App\Http\Controllers\PendingDisbursementController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FinancedController;
use App\Http\Controllers\LoanRepaidController;
use App\Http\Controllers\LoanRepaidThisMonthController;
use App\Http\Controllers\OutstandingController;
use App\Http\Controllers\OngoingTransactionController;
use App\Http\Controllers\ActiveCustomerController;
use App\Http\Controllers\ActiveSupplierController;
use App\Http\Controllers\NewOrderController;
use App\Http\Controllers\AgingController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HistoricalController;
use App\Http\Controllers\TotalBorrowerController;
use App\Http\Controllers\TotalOverDueController;
use App\Http\Controllers\RejectController;

Route::group(['middleware' => 'guest'], function () {

	Route::view('', 'login.index')->name('login.index');

    Route::group(['prefix' => 'login'], function () {
        Route::post('', [LoginController::class, 'store'])->name('login.store');
    });

});

Route::group(['middleware' => ['login', 'role.access']], function () {

	Route::group(['prefix' => 'dashboard'], function () {
	    Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
	});

    Route::group(['prefix' => 'supplier'], function () {
        Route::get('', [SupplierController::class, 'index'])->name('supplier.index');
        Route::get('create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('{id}/edit',[SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('{id}/update',[SupplierController::class, 'update'])->name('supplier.update');
        Route::get('{id}/destroy',[SupplierController::class, 'destroy'])->name('supplier.destroy');
        Route::get('{id}/restore',[SupplierController::class, 'restore'])->name('supplier.restore');
        Route::get('{id}/distributors',[SupplierController::class, 'distributors'])->name('supplier.distributors');
    });

    Route::group(['prefix' => 'banner-gratia'], function () {
        Route::get('', [BannerGratiaController::class, 'index'])->name('banner-gratia.index');
        Route::get('create', [BannerGratiaController::class, 'create'])->name('banner-gratia.create');
        Route::post('store', [BannerGratiaController::class, 'store'])->name('banner-gratia.store');
        Route::get('{id}/edit',[BannerGratiaController::class, 'edit'])->name('banner-gratia.edit');
        Route::post('{id}/update',[BannerGratiaController::class, 'update'])->name('banner-gratia.update');
        Route::get('{id}/destroy',[BannerGratiaController::class, 'destroy'])->name('banner-gratia.destroy');
    });

    Route::group(['prefix' => 'banner'], function () {
        Route::get('', [BannerController::class, 'index'])->name('banner.index');
        Route::get('create',[BannerController::class, 'create'])->name('banner.create');
        Route::post('store',[BannerController::class, 'store'])->name('banner.store');
        Route::get('{id}/edit',[BannerController::class, 'edit'])->name('banner.edit');
        Route::post('{id}/update',[BannerController::class, 'update'])->name('banner.update');
        Route::get('{id}/destroy',[BannerController::class, 'destroy'])->name('banner.destroy');

    });

    Route::group(['prefix' => 'reject'], function () {
        Route::get('', [RejectController::class, 'index'])->name('reject.index');
        Route::get('create',[RejectController::class, 'create'])->name('reject.create');
        Route::post('store',[RejectController::class, 'store'])->name('reject.store');
        Route::get('{id}/edit',[RejectController::class, 'edit'])->name('reject.edit');
        Route::post('{id}/update',[RejectController::class, 'update'])->name('reject.update');
        Route::get('{id}/destroy',[RejectController::class, 'destroy'])->name('reject.destroy');

    });

    Route::group(['prefix' => 'buyer-type'], function () {
        Route::get('', [BuyerTypeController::class, 'index'])->name('buyer-type.index');
        Route::get('create',[BuyerTypeController::class, 'create'])->name('buyer-type.create');
        Route::post('store',[BuyerTypeController::class, 'store'])->name('buyer-type.store');
        Route::get('{id}/edit',[BuyerTypeController::class, 'edit'])->name('buyer-type.edit');
        Route::post('{id}/update',[BuyerTypeController::class, 'update'])->name('buyer-type.update');
        Route::get('{id}/destroy',[BuyerTypeController::class, 'destroy'])->name('buyer-type.destroy');
    });

    Route::group(['prefix' => 'product-category'], function () {
        Route::get('', [ProductCategoryController::class, 'index'])->name('product-category.index');
        Route::get('create',[ProductCategoryController::class, 'create'])->name('product-category.create');
        Route::post('store',[ProductCategoryController::class, 'store'])->name('product-category.store');
        Route::get('{id}/edit',[ProductCategoryController::class, 'edit'])->name('product-category.edit');
        Route::post('{id}/update',[ProductCategoryController::class, 'update'])->name('product-category.update');
        Route::get('{id}/destroy',[ProductCategoryController::class, 'destroy'])->name('product-category.destroy');
        Route::get('{id}/restore',[ProductCategoryController::class, 'restore'])->name('product-category.restore');
    });

    Route::group(['prefix' => 'price-catalogue'], function () {
        Route::get('', [PriceCatalogueController::class, 'index'])->name('price-catalogue.index');
        Route::get('create', [PriceCatalogueController::class, 'create'])->name('price-catalogue.create');
        Route::post('store', [PriceCatalogueController::class, 'store'])->name('price-catalogue.store');
        Route::get('{id}/edit', [PriceCatalogueController::class, 'edit'])->name('price-catalogue.edit');
        Route::post('{id}/update', [PriceCatalogueController::class, 'update'])->name('price-catalogue.update');
        Route::get('{id}/destroy', [PriceCatalogueController::class, 'destroy'])->name('price-catalogue.destroy');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('', [ProductController::class, 'index'])->name('product.index');
        Route::get('create', [ProductController::class, 'create'])->name('product.create');
        Route::post('store', [ProductController::class, 'store'])->name('product.store');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('{id}/update', [ProductController::class, 'update'])->name('product.update');
        Route::get('{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('{id}/restore', [ProductController::class, 'restore'])->name('product.restore');
    });

    Route::group(['prefix' => 'stock'], function () {
        Route::get('', [StockController::class, 'index'])->name('stock.index');
        Route::get('create', [StockController::class, 'create'])->name('stock.create');
        Route::post('store', [StockController::class, 'store'])->name('stock.store');
        Route::get('{id}/edit', [StockController::class, 'edit'])->name('stock.edit');
        Route::post('{id}/update', [StockController::class, 'update'])->name('stock.update');
        Route::get('{id}/destroy', [StockController::class, 'destroy'])->name('stock.destroy');
    });

    Route::group(['prefix' => 'purchase-order'], function () {
        Route::get('', [PurchaseOrderController::class, 'index'])->name('purchase-order.index');
        Route::get('{id}', [PurchaseOrderController::class, 'view'])->name('purchase-order.view');
        Route::get('{id}/print', [PurchaseOrderController::class, 'print'])->name('purchase-order.print');
        Route::get('{id}/print-billing', [PurchaseOrderController::class, 'print_billing'])->name('purchase-order.print-billing');
        Route::get('{id}/approve', [PurchaseOrderController::class, 'approve'])->name('purchase-order.approve');
        Route::post('{id}/reject', [PurchaseOrderController::class, 'reject'])->name('purchase-order.reject');
    });

    Route::group(['prefix' => 'delivery-order'], function () {
        Route::get('', [DeliveryOrderController::class, 'index'])->name('delivery-order.index');
        Route::get('{id}', [DeliveryOrderController::class, 'view'])->name('delivery-order.view');
        Route::get('{id}/print', [DeliveryOrderController::class, 'print'])->name('delivery-order.print');
        Route::get('{id}/on-delivery', [DeliveryOrderController::class, 'onDelivery'])->name('delivery-order.onDelivery');
        Route::post('{id}/finish', [DeliveryOrderController::class, 'finish'])->name('delivery-order.finish');
    });

    Route::group(['prefix' => 'delivery-order-history'], function () {
        Route::get('', [DeliveryOrderHistoryController::class, 'index'])->name('delivery-order-history.index');
    });

    Route::group(['prefix' => 'financing'], function () {
        Route::get('', [FinancingController::class, 'index'])->name('financing.index');

        Route::group(['prefix' => 'invoice-apps'], function () {
            Route::get('{id}/upload', [FinancingController::class, 'getUploadInvApps'])->name('financing-inv-apps.edit');
            Route::post('{id}/upload', [FinancingController::class, 'uploadInvApps'])->name('financing-inv-apps.update');
        });

        Route::group(['prefix' => 'invoice-principal'], function () {
            Route::get('{id}/upload', [FinancingController::class, 'getUploadInvPrinc'])->name('financing-inv-princ.edit');
            Route::post('{id}/upload', [FinancingController::class, 'uploadInvPrinc'])->name('financing-inv-princ.update');
        });

        Route::group(['prefix' => 'p2p-status'], function () {

            Route::get('{id}', [FinancingController::class, 'getEditStatusP2P'])->name('financing-p2p.edit');
            Route::post('{id}', [FinancingController::class, 'EditStatusP2P'])->name('financing-p2p.update');
        });

        Route::group(['prefix' => 'disbursement'], function () {
            Route::get('{id}', [FinancingController::class, 'getEditDisbursement'])->name('financing-disbursement.edit');
            Route::post('{id}', [FinancingController::class, 'EditDisbursement'])->name('financing-disbursement.update');
        });

        Route::group(['prefix' => 'repayment'], function () {
            Route::get('{id}', [FinancingController::class, 'getEditRepayment'])->name('financing-repayment.edit');
            Route::post('{id}', [FinancingController::class, 'EditRepayment'])->name('financing-repayment.update');
        });

        Route::group(['prefix' => 'transfer-attachment'], function () {
            Route::get('{id}/disbursement', [FinancingController::class, 'getUploadDisbursementTransferAttachment'])->name('financing-upload-disbursement-transfer.edit');
            Route::post('{id}/disbursement', [FinancingController::class, 'uploadDisbursementTransferAttachment'])->name('financing-upload-disbursement-transfer.update');
            Route::get('{id}/repayment', [FinancingController::class, 'getUploadRepaymentTransferAttachment'])->name('financing-upload-repayment-transfer.edit');
            Route::post('{id}/repayment', [FinancingController::class, 'uploadRepaymentTransferAttachment'])->name('financing-upload-repayment-transfer.update');
        });
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('create',[CustomerController::class, 'create'])->name('customer.create');
        Route::post('store',[CustomerController::class, 'store'])->name('customer.store');
        Route::get('{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('{id}/update',[CustomerController::class, 'update'])->name('customer.update');
        Route::get('{id}/relation', [CustomerController::class, 'relation'])->name('customer.relation');
        Route::get('{id}/add-relation', [CustomerController::class, 'addRelation'])->name('customer.add-relation');
        Route::get('{id}/payment-type', [CustomerController::class, 'paymentType'])->name('customer.payment-type');
        Route::get('{id}/add-payment-type', [CustomerController::class, 'addPaymentType'])->name('customer.add-payment-type');
        Route::post('{id}/store-payment-type', [CustomerController::class, 'storePaymentType'])->name('customer.store-payment-type');
        Route::get('{customer_id}/{payment_id}/edit-payment-type', [CustomerController::class, 'editPaymentType'])->name('customer.edit-payment-type');
        Route::post('{customer_id}/{payment_id}/update-payment-type', [CustomerController::class, 'updatePaymentType'])->name('customer.update-payment-type');
        Route::get('{customer_id}/{payment_id}/destroy-payment', [CustomerController::class, 'destroyPaymentType'])->name('customer.destroy-payment');
        Route::get('{id}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy');
        Route::get('{id}/destroyRelation', [CustomerController::class, 'destroyRelation'])->name('customer.destroy-relation');
    });

    Route::group(['prefix' => 'new-customer'], function () {
        Route::get('', [NewCustomerController::class, 'index'])->name('new-customer.index');
        Route::get('{id}/accept', [NewCustomerController::class, 'accept'])->name('new-customer.accept');
        Route::get('{id}/destroy', [NewCustomerController::class, 'reject'])->name('new-customer.reject');
    });

    Route::group(['prefix' => 'map'], function () {
        Route::get('', [MapController::class, 'index'])->name('map.index');
        Route::get('{latne}/{lngne}/{latsw}/{lngsw}', [MapController::class, 'indexByLatLong'])->name('map.index-by-lat-long');
    });

    Route::group(['prefix' => 'ticket'], function () {
        Route::get('', [TicketController::class, 'index'])->name('ticket.index');
    });

    Route::group(['prefix' => 'log-activity'], function () {
        Route::get('', [LogActivityController::class, 'index'])->name('log-activity.index');
    });

    Route::group(['prefix' => 'log-login'], function () {
        Route::get('', [LogLoginController::class, 'index'])->name('log-login.index');
    });

    Route::group(['prefix' => 'access'], function () {
        Route::get('', [AccessController::class, 'index'])->name('access.index');
        Route::post('{id}/update', [AccessController::class, 'update'])->name('access.update');
    });

    Route::group(['prefix' => 'privacy-policy'], function () {
        Route::get('', [PrivacyPolicyController::class, 'index'])->name('privacy-policy.index');
        Route::post('update', [PrivacyPolicyController::class, 'update'])->name('privacy-policy.update');
    });

    Route::group(['prefix' => 'terms-condition'], function () {
        Route::get('', [TermsConditionController::class, 'index'])->name('terms-condition.index');
        Route::post('update', [TermsConditionController::class, 'update'])->name('terms-condition.update');
    });

    Route::group(['prefix' => 'notification'], function () {
       Route::get('', [NotificationController::class, 'index'])->name('notification.index');
       Route::get('create',[NotificationController::class, 'create'])->name('notification.create');
       Route::post('store',[NotificationController::class, 'store'])->name('notification.store');
       Route::get('{id}/edit',[NotificationController::class, 'edit'])->name('notification.edit');
       Route::post('{id}/update',[NotificationController::class, 'update'])->name('notification.update');
       Route::get('{id}/destroy',[NotificationController::class, 'destroy'])->name('notification.destroy');
    });

    Route::group(['prefix' => 'disbursement'], function () {
        Route::get('', [DisbursementController::class, 'index'])->name('disbursement.index');
    });

    Route::group(['prefix' => 'pending-disbursement'], function () {
        Route::get('', [PendingDisbursementController::class, 'index'])->name('pending-disbursement.index');
    });

    Route::group(['prefix' => 'available-credit-line'], function () {
        Route::get('', [AvailableCreditLineController::class, 'index'])->name('available-credit-line.index');
        Route::get('{id}', [AvailableCreditLineController::class, 'view'])->name('available-credit-line.view');
    });

    Route::group(['prefix' => 'aging'], function () {
        Route::get('', [AgingController::class, 'index'])->name('aging.index');
        Route::get('{year}/{month}', [AgingController::class, 'view'])->name('aging-view.index');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('', [OrderController::class, 'index'])->name('order.index');
    });

    Route::group(['prefix' => 'financed'], function () {
        Route::get('', [FinancedController::class, 'index'])->name('financed.index');
    });

    Route::group(['prefix' => 'loan-repaid'], function () {
        Route::get('', [LoanRepaidController::class, 'index'])->name('loan-repaid.index');
    });

    Route::group(['prefix' => 'loan-repaid-this-month'], function () {
        Route::get('', [LoanRepaidThisMonthController::class, 'index'])->name('loan-repaid-this-month.index');
    });

    Route::group(['prefix' => 'outstanding'], function () {
        Route::get('', [OutstandingController::class, 'index'])->name('outstanding.index');
    });

    Route::group(['prefix' => 'ongoing-transaction'], function () {
        Route::get('', [OngoingTransactionController::class, 'index'])->name('ongoing-transaction.index');
    });

    Route::group(['prefix' => 'totalOverDue'], function () {
        Route::get('',[TotalOverDueController::class, 'index'])->name('totaloverdue.index');
    });
    Route::group(['prefix' => 'active_customer'], function () {
        Route::get('', [ActiveCustomerController::class, 'index'])->name('active_customer.index');
    });

    Route::group(['prefix' => 'active_supplier'], function () {
        Route::get('', [ActiveSupplierController::class, 'index'])->name('active_supplier.index');
    });

    Route::group(['prefix' => 'new-order'], function () {
        Route::get('', [NewOrderController::class, 'index'])->name('new-order.index');
    });
    Route::group(['prefix' => 'total_overdue'], function () {
        Route::get('', [TotalOverDueController::class, 'index'])->name('total_overdue.index');
    });

    Route::group(['prefix' => 'total_borrower'], function () {
        Route::get('', [TotalBorrowerController::class, 'index'])->name('total_borrower.index');
    });

    Route::group(['prefix' => 'document'], function () {
        Route::get('{id}/upload', [DocumentController::class, 'index'])->name('document.index');
        Route::post('{id}/uploadLegal', [DocumentController::class, 'uploadLegal'])->name('document.upload-legal');
        Route::post('{id}/uploadAccounting', [DocumentController::class, 'uploadAccounting'])->name('document.upload-accounting');
        Route::post('{id}/uploadOther', [DocumentController::class, 'uploadOther'])->name('document.upload-other');
    });

    Route::group(['prefix' => 'historical'], function () {
        Route::get('{customer_id}', [HistoricalController::class, 'index'])->name('historical.index');
        Route::get('{customer_id}/{po_id}', [HistoricalController::class, 'view'])->name('historical.view');
    });

    Route::get('logout', [LoginController::class, 'destroy'])->name('login.destroy');
});
