<?php

/**
 * @var \ValoremPay\ValoremPayConnector $connector
 */
$connector = include __DIR__ . '/connector.php';

// Create transaction
$createTransactionRequest = $connector->valoremPay()->createTransaction(
    installments: 1,
    installmentType: 4,
    amount: 1000,
    softDescriptor: 'Lorem ipsum dolor.',
    statusNotificationUrl: 'https://example.com',
    useDecisionManager: false,
    postponeConfirmation: true,
);
$createTransactionResponse = $createTransactionRequest->object();

// Process payment
$processPaymentRequest = $connector->valoremPay()->processPayment(
    nit: $createTransactionResponse->payment->nit,
    card: new \ValoremPay\Entities\Card(
        number: '5448280000000007',
        expiryDate: '0128',
        securityCode: '123',
    )
);
$processPaymentResponse = $processPaymentRequest->object();

// Process payment later
$request = $connector->valoremPay()->processPaymentLater(nit: $processPaymentResponse->payment->nit);
$response = $request->object();

dump($request, $response);
