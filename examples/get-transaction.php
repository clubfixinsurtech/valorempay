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
    postponeConfirmation: false
);
$createTransactionResponse = $createTransactionRequest->object();

// Get transaction
$request = $connector->valoremPay()->getTransaction(nit: $createTransactionResponse->payment->nit);
$response = $request->object();

dump($request, $response);
