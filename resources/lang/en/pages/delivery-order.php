<?php

return [
    'title' => 'Delivery Order',
    'detail' => 'Delivery Detail',
    'table' => [
        'col_1' => 'DO Date',
        'col_2' => 'DO Number',
        'col_3' => 'PO Number',
        'col_4' => 'Customer',
        'col_5' => 'Status',
        'col_6' => 'Delivery Attachment',
        'col_7' => 'Invoice Attachment',
        'col_8' => 'Action'
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
            'total_label' => 'Total',
        ]
    ],
    'form' => [
        'do_date_label' => 'DO Date',
        'do_number_label' => 'DO Number',
        'po_number_label' => 'PO Number',
        'supplier_label' => 'Supplier',
        'payment_label' => 'Payment',
        'top_label' => 'TOP',
        'disbursement_percentage_label' => 'Disbursement Percentage',
        'delivery_attachment_label' => 'Delivery Attachment',
        'invoice_attachment_label' => 'Invoice Attachment'
    ]
];
