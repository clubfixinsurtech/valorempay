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
        postpone_confirmation: false,
        status_notification_url: 'example.com',
    )),
);
$transactionCreateResponse = $transactionCreateRequest->object();
$transactionCreateNit = $transactionCreateRequest->json('payment.nit');

// Process payment
$paymentProcessRequest = $connector->valoremPay()->paymentProcess(
    nit: new \ValoremPay\Entities\Nit($transactionCreateNit),
    payment: (new \ValoremPay\Strategies\PaymentProcessStrategy())
        ->setCard(
            new \ValoremPay\Entities\Card(
                number: '5448280000000007',
                expiry_date: '0128',
                security_code: '123',
            ),
        ),
);
$paymentProcessResponse = $paymentProcessRequest->object();
$paymentProcessNit = $paymentProcessRequest->json('payment.nit');

// Create cancellation
$cancellationCreateRequest = $connector->valoremPay()->cancellationCreate(
    nit: new \ValoremPay\Entities\Nit($paymentProcessNit),
);
$cancellationCreateResponse = $cancellationCreateRequest->object();
$cancellationCreateNit = $cancellationCreateRequest->json('cancellation_nit');

// Process cancellation
$request = $connector->valoremPay()->cancellationProcess(
    nit: new \ValoremPay\Entities\Nit($cancellationCreateNit),
);
$response = $request->object();

dump($request, $response);
