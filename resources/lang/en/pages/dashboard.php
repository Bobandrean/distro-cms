<?php

return [
    'title' => 'Dashboard',
    'subtitle' => 'All data shown below are Year To Date (YTD)',
    'widget' => [
        'currency_label' => 'Rupiah',
        'companies_unit_label' => 'Companies',
        'transaction_unit_label' => 'Transactions',
        'gtv_label' => 'Total GTV (Total Orders + Total Financed + Total Loan Repaid)',
        'principals_label' => 'Total Principals',
        'distributors_label' => 'Total Distributors',
        'active_principals_label' => 'Total Active & Inactive Principals on 6 Months',
        'active_distributors_label' => 'Total Active & Inactive Distributors on 6 Months',
        'orders_label' => 'Total Orders',
        'financed_label' => 'Total Financed',
        'loan_repaid_label' => 'Total Loan Repaid',
        'outstanding_label' => 'Total Outstanding',
        'ongoing_transaction_label' => 'On Going Transaction',
        'available_credit_line_label' => 'Available Credit Line',
        'total_over_due' => 'Total OverDue Transaction',
        'total_borrower' => 'Total Borrower',
        'top_product_categories' => [
            'title' => 'Top 10 Product Categories',
            'table' => [
                'col_1' => 'Product Category',
                'col_2' => 'Total Value'
            ]
        ],
        'top_products' => [
            'title' => 'Top 10 Products',
            'table' => [
                'col_1' => 'Product',
                'col_2' => 'Total Value'
            ]
        ],
        'top_customers' => [
            'title' => 'Top 10 Customers',
            'table' => [
                'col_1' => 'Customers',
                'col_2' => 'Total Value'
            ]
        ],
        'gtv_cso_label' => 'Total GTV (Loan Repaid)',
        'gtv_this_month_cso_label' => 'This Month GTV (Loan Repaid)',
        'new_orders_label' => 'New Orders',
        'disbursement_label' => 'Disbursement',
        'undisbursement_label' => 'Pending Disbursement',
        'number_of_orders_year_to_date_label' => 'Number of Orders Year To date'
    ]
];
