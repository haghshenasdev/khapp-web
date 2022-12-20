<?php

return [

    /**
     *  driver class namespace
     */
    'driver' => Omalizadeh\MultiPayment\Drivers\Saman\Saman::class,

    /**
     *  soap client options
     */
    'soap_options' => [
        'encoding' => 'UTF-8'
    ],

    /**
     *  gateway configurations
     *  merchant_id is the same as terminal_id
     */
    'main' => [
        'terminal_id' => '21486240',
        'callback_url' => url('v1/'.request()->route('charity').'/verify'),
        'callback_method' => 'POST', // supported values: POST, GET
        'description' => 'payment using saman',
    ],
    'other' => [
        'terminal_id' => '',
        'callback_url' => 'https://yoursite.com/path/to',
        'callback_method' => 'POST',
        'description' => 'payment using saman',
    ]
];
