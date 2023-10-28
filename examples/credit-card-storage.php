<?php

/**
 * @var \ValoremPay\ValoremPayConnector $connector
 */
$connector = include __DIR__ . '/connector.php';

// Credit card storage
$request = $connector->valoremPay()->creditCardStorage(
    merchantUsn: '123456',
    customerId: '123456789'
);
$response = $request->object();

dump($request, $response);
