<?php

return [
    'title' => 'Historical Transaction',
    'detail' => 'Historical Transaction Detail',
    'table' => [
        'col_1' => 'Date',
        'col_2' => 'PO Number',
        'col_3' => 'Distributor',
        'col_4' => 'Supplier',
        'col_5' => 'Total',
        'col_6' => 'Payment Status'
    ],
    'detail-table' => [
        'col_1' => 'Item',
        'col_2' => 'Quantity',
        'col_3' => 'Price',
        'col_4' => 'Total',
        'footer' => [
            'subtotal_label' => 'Subtotal',
            'admin_fee_label' => 'Admin Fee',
            'interest_fee_label' => 'Interest Fee',
            'total_label' => 'Total'
        ]
    ],
    'form' => [
        'po_number_label' => 'PO Number',
        'date_label' => 'Date',
        'supplier_label' => 'Supplier',
        'payment_label' => 'Payment',
        'top_label' => 'TOP',
        'disbursement_percentage_label' => 'Disbursement Percentage'
    ]
];
