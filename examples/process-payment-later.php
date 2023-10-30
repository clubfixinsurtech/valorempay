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
        'postpone_confirmation' => true,
    ],
]);
$createTransactionResponse = $createTransactionRequest->object();

// Process payment
$processPaymentRequest = $connector->valoremPay()->processPayment(
    nit: new \ValoremPay\Entities\Nit($createTransactionResponse->payment->nit),
    options: [
        'card' => (new \ValoremPay\Entities\Card(number: '5448280000000007', expiryDate: '0128', securityCode: '123',))->toArray(),
    ],
);
$processPaymentResponse = $processPaymentRequest->object();

// Process payment later
$request = $connector->valoremPay()->processPaymentLater(nit: new \ValoremPay\Entities\Nit($processPaymentResponse->payment->nit));
$response = $request->object();

dump($request, $response);
