<?php

/**
 * @var \ValoremPay\ValoremPayConnector $connector
 */
$connector = include __DIR__ . '/connector.php';

// Create transaction
$request = $connector->valoremPay()->createTransaction([
    'installments' => 1,
    'installment_type' => 4,
    'amount' => 1000,
    'soft_descriptor' => 'Lorem ipsum dolor',
    'additional_data' => [
        'status_notification_url' => 'https://example.com',
        'use_decision_manager' => false,
        'postpone_confirmation' => false,
    ],
]);
$response = $request->object();

dump($request, $response);
