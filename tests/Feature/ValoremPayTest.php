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
        $transactionCreate = $this->createSampleTransaction();
        $response = $transactionCreate->object();

        $this->assertIsObject($response);
        $this->assertStatus(201, $transactionCreate);
        $this->assertObjectHasAttribute('payment', $response);
        $this->assertObjectHasAttribute('nit', $response->payment);
    }

    public function test_get_transaction(): void
    {
        $transactionCreate = $this->createSampleTransaction();
        $transactionCreateNit = $transactionCreate->json('payment.nit');

        $transactionDetail = $this->valoremPay->transactionDetail(
            nit: new \ValoremPay\Entities\Nit($transactionCreateNit),
        );
        $response = $transactionDetail->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $transactionDetail);
        $this->assertObjectHasAttribute('payment', $response);
        $this->assertObjectHasAttribute('nit', $response->payment);
    }

    public function test_process_payment(): void
    {
        $transactionCreate = $this->createSampleTransaction();
        $transactionCreateNit = $transactionCreate->json('payment.nit');

        $paymentProcess = $this->valoremPay->paymentProcess(
            nit: new \ValoremPay\Entities\Nit($transactionCreateNit),
            payment: (new \ValoremPay\Strategies\PaymentProcessStrategy())->setCard($this->createSampleCard()),
        );
        $response = $paymentProcess->object();

        $this->assertIsObject($response);
        $this->assertStatus(201, $paymentProcess);
        $this->assertObjectHasAttribute('payment', $response);
        $this->assertObjectHasAttribute('nit', $response->payment);
    }

    public function test_process_payment_later(): void
    {
        $transactionCreate = $this->createSampleTransaction(postponeConfirmation: true);
        $transactionCreateNit = $transactionCreate->json('payment.nit');

        $paymentProcess = $this->valoremPay->paymentProcess(
            nit: new \ValoremPay\Entities\Nit($transactionCreateNit),
            payment: (new \ValoremPay\Strategies\PaymentProcessStrategy())->setCard($this->createSampleCard()),
        );
        $paymentProcessNit = $paymentProcess->json('payment.nit');

        $paymentProcessLater = $this->valoremPay->paymentProcessLater(
            nit: new \ValoremPay\Entities\Nit($paymentProcessNit),
        );
        $response = $paymentProcessLater->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $paymentProcessLater);
        $this->assertObjectHasAttribute('payment', $response);
        $this->assertObjectHasAttribute('nit', $response->payment);
    }

    public function test_create_cancellation(): void
    {
        $transactionCreate = $this->createSampleTransaction();
        $transactionCreateNit = $transactionCreate->json('payment.nit');

        $paymentProcess = $this->valoremPay->paymentProcess(
            nit: new \ValoremPay\Entities\Nit($transactionCreateNit),
            payment: (new \ValoremPay\Strategies\PaymentProcessStrategy())->setCard($this->createSampleCard()),
        );
        $paymentProcessNit = $paymentProcess->json('payment.nit');

        $cancellationCreate = $this->valoremPay->cancellationCreate(
            nit: new \ValoremPay\Entities\Nit($paymentProcessNit),
        );
        $response = $cancellationCreate->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $cancellationCreate);
        $this->assertEquals($transactionCreateNit, $paymentProcessNit);
        $this->assertObjectHasAttribute('cancellation_nit', $response);
    }

    public function test_process_cancellation(): void
    {
        $transactionCreate = $this->createSampleTransaction();
        $transactionCreateNit = $transactionCreate->json('payment.nit');

        $paymentProcess = $this->valoremPay->paymentProcess(
            nit: new \ValoremPay\Entities\Nit($transactionCreateNit),
            payment: (new \ValoremPay\Strategies\PaymentProcessStrategy())->setCard($this->createSampleCard()),
        );
        $paymentProcessNit = $paymentProcess->json('payment.nit');

        $cancellationCreate = $this->valoremPay->cancellationCreate(
            nit: new \ValoremPay\Entities\Nit($paymentProcessNit),
        );
        $cancellationCreateNit = $cancellationCreate->json('cancellation_nit');

        $cancellationProcess = $this->valoremPay->cancellationProcess(
            nit: new \ValoremPay\Entities\Nit($cancellationCreateNit),
        );
        $response = $cancellationProcess->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $cancellationProcess);
        $this->assertObjectHasAttribute('cancellation', $response);
    }

    public function test_credit_card_storage(): void
    {
        $cardStorage = $this->valoremPay->cardStorage(merchantUsn: '123456', customerId: '123456789');
        $response = $cardStorage->object();

        $this->assertIsObject($response);
        $this->assertStatus(201, $cardStorage);
        $this->assertObjectHasAttribute('body', $response);
        $this->assertObjectHasAttribute('nita', $response->body);
    }

    public function test_sync_credit_card_storage(): void
    {
        $cardStorage = $this->valoremPay->cardStorage(merchantUsn: '123456', customerId: '123456789');
        $nita = $cardStorage->json('body.nita');
        $storeToken = $cardStorage->json('body.store_token');

        $card = $this->createSampleCard();
        $cardSync = $this->valoremPay->cardSync(nita: $nita, storeToken: $storeToken, card: $card);
        $response = $cardSync->object();

        $this->assertIsObject($response);
        $this->assertStatus(200, $cardSync);
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
        return $this->valoremPay->transactionCreate((new \ValoremPay\Strategies\TransactionCreateStrategy(
            installments: 1,
            installment_type: \ValoremPay\Enums\InstallmentType::STORE_WITHOUT_INTEREST,
            amount: 1000,
        ))->setAdditionalData(
            (new \ValoremPay\Entities\AdditionalData(
                postpone_confirmation: $postponeConfirmation,
                status_notification_url: 'example.com',
            )),
        ));
    }

    private function createSampleCard(): \ValoremPay\Entities\Card
    {
        return new \ValoremPay\Entities\Card(number: '5448280000000007', expiry_date: '0128', security_code: '123',);
    }
}