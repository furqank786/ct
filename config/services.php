<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

   'github' => [
        'token' => env('GITHUB_TOKEN'),
    ],

    'mailgun' => [
        'domain' => env('MAIL_USERNAME'),
        'secret' => env('MAIL_PASSWORD'),
    ],

    'mandrill' => [
        'secret' => env('MAIL_PASSWORD'),
    ],

    'nexmo' => [
        'key'      => env('NEXMO_KEY'),
        'secret'   => env('NEXMO_SECRET'),
        'sms_from' => env('NEXMO_SMS_FROM'),
    ],

    'ses' => [
        'key'    => env('MAIL_USERNAME'),
        'secret' => env('MAIL_PASSWORD'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('MAIL_PASSWORD'),
    ],

    'google' => [
        'client_id' => '735830701012-8i7ln4aibcetlc32cagjv4016glmjvlo.apps.googleusercontent.com',
        'client_secret' => 'HtvNPXBMVmqiqLGinAkAFeos',
        'redirect' => 'http://status-dev.dynabic.com/auth/login/callback',
    ],

];
