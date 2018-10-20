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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
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
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id'     => '664656557268458',
        'client_secret' => '11bc24b92b2559a2f3187e4be182f364',
        'redirect'      => 'http://localhost/Gawebny/public/login/facebook/callback',
    ],
    'google' => [
        'client_id'     => '686711338715-nb1qqv75394080cbaka524jlh7uo8q29.apps.googleusercontent.com',
        'client_secret' => 'XcXt6Ycz12QTDZz0wU6xCsmV',
        'redirect'      => 'http://localhost/Gawebny/public/login/google/callback',
    ],

];
