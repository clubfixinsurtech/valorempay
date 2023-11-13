<?php

/**
 * @var \ValoremPay\ValoremPayConnector $connector
 */
$connector = include __DIR__ . '/connector.php';

// Credit card storage
$cardStorageRequest = $connector->valoremPay()->cardStorage(
    merchantUsn: '123456',
    customerId: '123456789'
);
$cardStorageResponse = $cardStorageRequest->object();
$nita = $cardStorageRequest->json('body.nita');
$storeToken = $cardStorageRequest->json('body.store_token');

// Sync credit card storage
$request = $connector->valoremPay()->cardSync(
    nita: $nita,
    storeToken: $storeToken,
    card: new \ValoremPay\Entities\Card(
        number: '5448280000000007',
        expiry_date: '0128',
        security_code: '123',
    ),
);
$response = $request->object();

dump($request, $response);
