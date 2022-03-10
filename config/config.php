<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'database' => [
        'connection' => env('DB_PINTEREST_API_CONNECTION'),
    ],

    'clientId' => env('PINTEREST_API_CLIENT_ID'),
    'clientSecret' => env('PINTEREST_API_CLIENT_SECRET'),

    'adAccountId' => env('PINTEREST_API_AD_ACCOUNT_ID'),
];
