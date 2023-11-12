<?php

/**
 * @var \ValoremPay\ValoremPayConnector $connector
 */
$connector = include __DIR__ . '/connector.php';

// Create transaction
$transaction = (new \ValoremPay\Strategies\TransactionCreateStrategy(
    installments: 1,
    installment_type: \ValoremPay\Enums\InstallmentType::STORE_WITHOUT_INTEREST,
    amount: 1000,
))->setAdditionalData(
    (new \ValoremPay\Entities\AdditionalData(
        status_notification_url: 'example.com',
    )),
);

$request = $connector->valoremPay()->transactionCreate($transaction);
$response = $request->object();

dump($request, $response);
