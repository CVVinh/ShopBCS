<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '997433701402-ho5qicu6jomt6aetbvrii5bftk0tq1lt.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:81/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '542746383972570',
        'client_secret' => '64f11c518c5ce75c38c744a097d1d2ce',
        'redirect' => 'http://localhost:81/auth/facebook/callback',
    ],

];
