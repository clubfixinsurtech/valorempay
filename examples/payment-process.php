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

// Process payment
$request = $connector->valoremPay()->paymentProcess(
    nit: new \ValoremPay\Entities\Nit($nit),
    payment: (new \ValoremPay\Strategies\PaymentProcessStrategy())
        ->setCard(
            new \ValoremPay\Entities\Card(
                number: '5448280000000007',
                expiry_date: '0128',
                security_code: '123',
            ),
        ),
);
$response = $request->object();

dump($request, $response);
