<?php

/**
 * @var \ValoremPay\ValoremPayConnector $connector
 */
$connector = include __DIR__ . '/connector.php';

// Create transaction
$transactionCreateRequest = $connector->valoremPay()->transactionCreate(
    (new \ValoremPay\Strategies\TransactionCreateStrategy(
        installments: 1,
        installment_type: \ValoremPay\Enums\InstallmentType::STORE_WITHOUT_INTEREST,
        amount: 1000,
    ))->setAdditionalData(new \ValoremPay\Entities\AdditionalData(
        status_notification_url: 'example.com',
    )),
);
$transactionCreateResponse = $transactionCreateRequest->object();
$nit = $transactionCreateRequest->json('payment.nit');

// Get transaction
$request = $connector->valoremPay()->transactionDetail(nit: new \ValoremPay\Entities\Nit($nit));
$response = $request->object();

dump($request, $response);
