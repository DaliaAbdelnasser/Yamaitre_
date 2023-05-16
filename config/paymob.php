<?php

return [
    'controller' => '\ctf0\PayMob\Controllers\PaymentController',
    'accept'     => [
        'api_key'         => env('PAYMOB_API_KEY'),
        'merchant_id'     => env('PAYMOB_MERCHANT_ID'),
        'delivery_needed' => false,
        'conversion_rate' => 100, // cents
        'currency'        => 'EGP',
        'exp_after'       => 10, // seconds
        'min_amount'      => 5, // pounds
        'url'             => [
            'token'       => 'https://accept.paymobsolutions.com/api/auth/tokens',
            'order'       => 'https://accept.paymobsolutions.com/api/ecommerce/orders',
            'payment_key' => 'https://accept.paymobsolutions.com/api/acceptance/payment_keys',
            'refund'      => 'https://accept.paymobsolutions.com/api/acceptance/void_refund/refund',
            'hmac'        => 'https://accept.paymobsolutions.com/api/acceptance/transactions',
        ],
        'payment_types' => [
            'card_payment' => [
                'url'            => 'https://accept.paymobsolutions.com/api/acceptance/iframes/' . env('PAYMOB_IFRAME_ID'),
                'integration_id' => env('PAYMOB_INTEGRATION_ID'),
            ],
        ],
    ],
];
