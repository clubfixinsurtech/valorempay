<?php

/**
 * @var \ValoremPay\ValoremPayConnector $connector
 */
$connector = include __DIR__ . '/connector.php';

// Create transaction
$createTransactionRequest = $connector->valoremPay()->createTransaction([
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
$createTransactionResponse = $createTransactionRequest->object();

// Get transaction
$request = $connector->valoremPay()->getTransaction(nit: new \ValoremPay\Entities\Nit($createTransactionResponse->payment->nit));
$response = $request->object();

dump($request, $response);
