<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
    'client_id' => '831352256991728',
    'client_secret' => 'c7a98bc2ea29f24cd05d5433b03d1428',
    'redirect' => 'http://192.168.1.23:5000/api/v1/auth/callback/facebook',
],
    
    'google' => [
    'client_id' => '86073781930-qg5mmrsa6s89cqvuruc8j0n2dmi75n4e.apps.googleusercontent.com',
    'client_secret' => '7f-zAp4RFohZIBPRdp91LDGO',
    'redirect' => 'http://localhost:8000/api/v1/auth/callback/google',
],
    
    'twitter' => [
    'client_id' => '86073781930-qg5mmrsa6s89cqvuruc8j0n2dmi75n4e.apps.googleusercontent.com',
    'client_secret' => '7f-zAp4RFohZIBPRdp91LDGO',
    'redirect' => 'http://localhost:8000/api/v1/auth/callback/twitter',
],


];
