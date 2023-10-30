<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

class ValoremPayTest extends TestCase
{
    private \ValoremPay\ValoremPayResource $valoremPay;

    protected function assertPreConditions(): void
    {
        $configFile = dirname(__DIR__, 2) . '/examples/config.php';

        $this->assertConfigFileExists($configFile);

        $config = include $configFile;

        $this->assertArrayHasKey('client_id', $config, 'Client ID is missing in config');
        $this->assertNotEmpty($config['client_id'], 'Client ID is empty');

        $this->assertArrayHasKey('client_secret', $config, 'Client secret is missing in config');
        $this->assertNotEmpty($config['client_secret'], 'Client secret is empty');
    }

    protected function setUp(): void
    {
        $config = include dirname(__DIR__, 2) . '/examples/config.php';
        $clientId = $config['client_id'];
        $clientSecret = $config['client_secret'];

        $connector = new \ValoremPay\ValoremPayConnector(clientId: $clientId, clientSecret: $clientSecret);
        $this->valoremPay = $connector->valoremPay();
    }

    public function test_create_transaction(): void
    {
        $createTransaction = $this->createSampleTransaction();
        $response = $createTransaction->object();

        $this->assertIsObject($response);
        $this->assertStatus(201, $createTransaction);
        $this->assertObjectHasAttribute('payment', $response);
        $this->assertObjectHasAttribute('nit', $response->payment);
    }

    public function test_get_transaction(): void
    {
        $createTransaction = $this->createSampleTransaction();
        $nit = new \ValoremPay\Entities\Nit($createTransaction->object()->payment->nit);

        $getTransaction = $this->valoremPay->getTransaction(nit: $nit);
        $response = $getTransaction->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $getTransaction);
        $this->assertObjectHasAttribute('payment', $response);
        $this->assertObjectHasAttribute('nit', $response->payment);
    }

    public function test_process_payment(): void
    {
        $createTransaction = $this->createSampleTransaction();
        $nit = new \ValoremPay\Entities\Nit($createTransaction->object()->payment->nit);

        $options = $this->createSamplePayment();
        $processPayment = $this->valoremPay->processPayment(nit: $nit, options: $options);
        $response = $processPayment->object();

        $this->assertIsObject($response);
        $this->assertStatus(201, $processPayment);
        $this->assertObjectHasAttribute('payment', $response);
        $this->assertObjectHasAttribute('nit', $response->payment);
    }

    public function test_process_payment_later(): void
    {
        $createTransaction = $this->createSampleTransaction(postponeConfirmation: true);
        $nit = new \ValoremPay\Entities\Nit($createTransaction->object()->payment->nit);

        $options = $this->createSamplePayment();
        $processPayment = $this->valoremPay->processPayment(nit: $nit, options: $options);
        $processPaymentNit = new \ValoremPay\Entities\Nit($processPayment->object()->payment->nit);

        $processPaymentLater = $this->valoremPay->processPaymentLater(nit: $processPaymentNit);
        $response = $processPaymentLater->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $processPaymentLater);
        $this->assertObjectHasAttribute('payment', $response);
        $this->assertObjectHasAttribute('nit', $response->payment);
    }

    public function test_create_cancellation(): void
    {
        $createTransaction = $this->createSampleTransaction();
        $nit = new \ValoremPay\Entities\Nit($createTransaction->object()->payment->nit);

        $options = $this->createSamplePayment();
        $processPayment = $this->valoremPay->processPayment(nit: $nit, options: $options);
        $processPaymentNit = new \ValoremPay\Entities\Nit($processPayment->object()->payment->nit);

        $createCancellation = $this->valoremPay->createCancellation(nit: $processPaymentNit);
        $response = $createCancellation->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $createCancellation);
        $this->assertEquals($nit, $processPaymentNit);
        $this->assertObjectHasAttribute('cancellation_nit', $response);
    }

    public function test_create_cancellation_with_payment_later(): void
    {
        $this->markTestSkipped('This test is not working');

        $createTransaction = $this->createSampleTransaction(postponeConfirmation: true);
        $nit = new \ValoremPay\Entities\Nit($createTransaction->object()->payment->nit);

        $options = $this->createSamplePayment();
        $processPayment = $this->valoremPay->processPayment(nit: $nit, options: $options);
        $processPaymentNit = new \ValoremPay\Entities\Nit($processPayment->object()->payment->nit);

        $processPaymentLater = $this->valoremPay->processPaymentLater(nit: $processPaymentNit);

        $createCancellation = $this->valoremPay->createCancellation(nit: $processPaymentNit);
        $response = $createCancellation->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $createCancellation);
        $this->assertObjectHasAttribute('cancellation_nit', $response);
    }

    public function test_process_cancellation(): void
    {
        $createTransaction = $this->createSampleTransaction();
        $nit = new \ValoremPay\Entities\Nit($createTransaction->object()->payment->nit);

        $options = $this->createSamplePayment();
        $processPayment = $this->valoremPay->processPayment(nit: $nit, options: $options);
        $processPaymentNit = new \ValoremPay\Entities\Nit($processPayment->object()->payment->nit);

        $createCancellation = $this->valoremPay->createCancellation(nit: $processPaymentNit);
        $cancellationNit = new \ValoremPay\Entities\Nit($createCancellation->object()->cancellation_nit);

        $processCancellation = $this->valoremPay->processCancellation(nit: $cancellationNit);
        $response = $processCancellation->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $processCancellation);
        $this->assertObjectHasAttribute('cancellation', $response);
    }

    public function test_credit_card_storage(): void
    {
        $creditCardStorage = $this->valoremPay->creditCardStorage(merchantUsn: '123456', customerId: '123456789');
        $response = $creditCardStorage->object();

        $this->assertIsObject($response);
        $this->assertStatus(201, $creditCardStorage);
        $this->assertObjectHasAttribute('body', $response);
        $this->assertObjectHasAttribute('nita', $response->body);
    }

    public function test_sync_credit_card_storage(): void
    {
        $creditCardStorage = $this->valoremPay->creditCardStorage(merchantUsn: '123456', customerId: '123456789');
        $creditCardStorageResponse = $creditCardStorage->object();
        $nita = $creditCardStorageResponse->body->nita;
        $storeToken = $creditCardStorageResponse->body->store_token;

        $card = $this->createSampleCard();
        $syncCreditCardStorage = $this->valoremPay->syncCreditCardStorage(nita: $nita, storeToken: $storeToken, card: $card);
        $response = $syncCreditCardStorage->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $syncCreditCardStorage);
        $this->assertObjectHasAttribute('body', $response);
        $this->assertObjectHasAttribute('nita', $response->body);
    }

    private function assertConfigFileExists(string $filePath): void
    {
        $this->assertTrue(file_exists($filePath), 'File config.php does not exist');
    }

    private function assertObjectHasAttribute(string $attribute, object $object): void
    {
        $this->assertTrue(property_exists($object, $attribute), "Property $attribute does not exist");
    }

    private function assertStatus(int $expected, \Saloon\Http\Response $response): void
    {
        $this->assertEquals($expected, $response->status(), 'Status code is not ' . $expected);
    }

    private function createSampleTransaction(bool $postponeConfirmation = false): \Saloon\Http\Response
    {
        $options = [
            'installments' => 1,
            'installment_type' => 4,
            'amount' => 1000,
            'soft_descriptor' => 'Lorem ipsum dolor',
            'additional_data' => [
                'status_notification_url' => 'https://example.com',
                'use_decision_manager' => false,
                'postpone_confirmation' => false,
            ],
        ];

        if ($postponeConfirmation) {
            $options['additional_data']['postpone_confirmation'] = true;
        }

        return $this->valoremPay->createTransaction($options);
    }

    private function createSampleCard(): \ValoremPay\Entities\Card
    {
        return new \ValoremPay\Entities\Card(number: '5448280000000007', expiryDate: '0128', securityCode: '123');
    }

    private function createSamplePayment(): array
    {
        return [
            'card' => $this->createSampleCard()->toArray(),
        ];
    }
}