<?php

return [
    'paper' => [0, 0, 612, 252], // points: 8.5in x 3.5in
    'currency_word' => 'Dollars',
    'date_format' => 'm/d/Y',

    'payer' => [
        'name' => env('CHECK_PAYER_NAME', 'Company Name'),
        'address' => env('CHECK_PAYER_ADDRESS', ''),
    ],

    'bank' => [
        'name' => env('CHECK_BANK_NAME', 'Bank Name'),
        'routing_number' => env('CHECK_ROUTING_NUMBER', ''),
        'account_number' => env('CHECK_ACCOUNT_NUMBER', ''),
    ],

    'view' => 'check-printing::check',
];
