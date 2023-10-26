<?php

require_once __DIR__ . '/vendor/autoload.php';

// =====================================================================

// SETUP

$asaasKey = '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwMzkxNDY6OiRhYWNoXzgxMTk2NDg4LTU4YmItNGY2ZC1hNGY2LTU1ZWMzNTE4ZDQ1Zg==';

$connector = new \Asaas\AsaasConnector($asaasKey, false);

// =====================================================================

// CUSTOMER

$customer = (new \Asaas\Entities\Customer(
    name: 'Sergio Danilo Jr',
    cpfCnpj: '05506426500',
    phone: '41992885586'
));

$response = $connector->send(new Asaas\Requests\Customer\Create($customer));

$customerId = $response->json('id');

// =====================================================================

// CREDIT CARD

// =====================================================================

// PAYMENT
$dueDate = (new DateTime())
    ->setTimezone((new DateTimeZone("America/Sao_Paulo")))
    ->setTime(0, 0);

$payment = (new \Asaas\Entities\Payment(
    customer: $customerId,
    value: 12.5,
    dueDate: $dueDate,
    billingType: \Asaas\Enums\BillingType::BOLETO
))->when(
        true,
        function (\Asaas\Entities\Payment $payment) {
            $payment->remoteIp('127.0.0.1');
        }
    )->withCardToken('baguá');

$request = new \Asaas\Requests\Payments\Create($payment);
$response = $connector->send($request);

dd(
    $response->status(),
    $response->clientError(),
    $response->json(),
);
