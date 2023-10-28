<?php

/**
 * @var \ValoremPay\ValoremPayConnector $connector
 */
$connector = include __DIR__ . '/connector.php';

// Credit card storage
$creditCardStorageRequest = $connector->valoremPay()->creditCardStorage(
    merchantUsn: '123456',
    customerId: '123456789'
);
$creditCardStorageResponse = $creditCardStorageRequest->object();

// Sync credit card storage
$request = $connector->valoremPay()->syncCreditCardStorage(
    nita: $creditCardStorageResponse->body->nita,
    storeToken: $creditCardStorageResponse->body->store_token,
    card: new \ValoremPay\Entities\Card(
        number: '5448280000000007',
        expiryDate: '0128',
        securityCode: '123',
    )
);
$response = $request->object();

dump($request, $response);
