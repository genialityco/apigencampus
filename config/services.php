<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */
    'google' => [
        'client_id' => '460431972981-r4uke7pnlhvd16dvv91k63rav7bii9do.apps.googleusercontent.com',    
        'client_secret' => 'ZxPdxAgtzb98LpB0yqGdqJIr',
        'redirect' => '',
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'sendinblue' => [
        'url' => 'https://api.sendinblue.com/v2.0',
        'key' => env('SENDINBLUE_KEY', 'w1Arma30zZfOcPGQ'),
     ],
         
    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Account::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'firebase' => [
        'api_key' => 'AIzaSyDDnc9WHXf4CWwXCVggeiarYGu_xBgibJY', // Only used for JS integration
        'auth_domain' => 'eviusauth.firebaseapp.com', // Only used for JS integration
        'database_url' => 'https://eviusauth.firebaseio.com',
        'projectId' => "eviusauth",
        'storage_bucket' => 'eviusauth.appspot.com', 
        'messagingSenderId' => "400499146867",
        'appId' => "1:400499146867:web:5d0021573a43a1df"
    ]
];