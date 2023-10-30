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

// Process payment
$processPaymentRequest = $connector->valoremPay()->processPayment(
    nit: new \ValoremPay\Entities\Nit($createTransactionResponse->payment->nit),
    options: [
        'card' => (new \ValoremPay\Entities\Card(number: '5448280000000007', expiryDate: '0128', securityCode: '123',))->toArray(),
    ],
);
$processPaymentResponse = $processPaymentRequest->object();

// Create cancellation
$createCancellationRequest = $connector->valoremPay()->createCancellation(nit: new \ValoremPay\Entities\Nit($processPaymentResponse->payment->nit));
$createCancellationResponse = $createCancellationRequest->object();

// Process cancellation
$request = $connector->valoremPay()->processCancellation(nit: new \ValoremPay\Entities\Nit($createCancellationResponse->cancellation_nit));
$response = $request->object();

dump($request, $response);
