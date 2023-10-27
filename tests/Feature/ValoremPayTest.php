<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use ValoremPay\Entities\Card;

class ValoremPayTest extends TestCase
{
    protected function setUp(): void
    {
        $clientId = '';
        $clientSecret = '';

        $connector = new \ValoremPay\ValoremPayConnector(clientId: $clientId, clientSecret: $clientSecret);
        $this->valoremPay = $connector->valoremPay();
    }

    public function test_create_transaction(): void
    {
        $createTransaction = $this->valoremPay->createTransaction();
        $response = $createTransaction->object();

        $this->assertIsObject($response);
        $this->assertEquals(201, $createTransaction->status());
        $this->assertTrue(property_exists($response, 'payment'));
    }

    public function test_get_transaction(): void
    {
        $createTransaction = $this->valoremPay->createTransaction();
        $nit = $createTransaction->object()->payment->nit;

        $getTransaction = $this->valoremPay->getTransaction(nit: $nit);
        $response = $getTransaction->object();

        $this->assertIsObject($response);
        $this->assertEquals(200, $getTransaction->status());
        $this->assertTrue(property_exists($response, 'payment'));
    }

    public function test_create_payment(): void
    {
        $createTransaction = $this->valoremPay->createTransaction();
        $nit = $createTransaction->object()->payment->nit;
        $card = new Card(number: '5448280000000007', expiryDate: '0128', securityCode: '123');

        $createPayment = $this->valoremPay->createPayment(nit: $nit, card: $card);
        $response = $createPayment->object();

        $this->assertIsObject($response);
        $this->assertEquals(201, $createPayment->status());
        $this->assertTrue(property_exists($response, 'payment'));
    }

    public function test_confirm_payment(): void
    {
        $this->markTestSkipped('This test is not working');

        $createTransaction = $this->valoremPay->createTransaction();
        $nit = $createTransaction->object()->payment->nit;

        $confirmPayment = $this->valoremPay->confirmPayment(nit: $nit);
        $response = $confirmPayment->object();

        $this->assertIsObject($response);
        $this->assertEquals(200, $confirmPayment->status());
        $this->assertTrue(property_exists($response, 'payment'));
    }

    public function test_create_cancellation(): void
    {
        $this->markTestSkipped('This test is not working');

        $createTransaction = $this->valoremPay->createTransaction();
        $nit = $createTransaction->object()->payment->nit;

        $createCancellation = $this->valoremPay->createCancellation(nit: $nit);
        $response = $createCancellation->object();

        $this->assertIsObject($response);
        $this->assertEquals(200, $createCancellation->status());
        $this->assertTrue(property_exists($response, 'cancellation_nit'));
    }

    public function test_confirm_cancellation(): void
    {
        $this->markTestSkipped('This test is not working');

        $createTransaction = $this->valoremPay->createTransaction();
        $nit = $createTransaction->object()->payment->nit;

        $confirmCancellation = $this->valoremPay->confirmCancellation(nit: $nit);
        $response = $confirmCancellation->object();

        $this->assertIsObject($response);
        $this->assertEquals(200, $confirmCancellation->status());
        $this->assertTrue(property_exists($response, 'cancellation'));
    }

    public function test_store_sync(): void
    {
        $storeSync = $this->valoremPay->storeSync(merchantUsn: '123456', customerId: '123456789');
        $response = $storeSync->object();

        $this->assertIsObject($response);
        $this->assertEquals(201, $storeSync->status());
        $this->assertTrue(property_exists($response, 'body'));
    }

    public function test_store_sync_put(): void
    {
        $storeSync = $this->valoremPay->storeSync(merchantUsn: '123456', customerId: '123456789');
        $nita = $storeSync->object()->body->nita;
        $storeToken = $storeSync->object()->body->store_token;

        $storeSyncPut = $this->valoremPay->storeSyncPut(nita: $nita, storeToken: $storeToken);
        $response = $storeSyncPut->object();

        $this->assertIsObject($response);
        $this->assertEquals(200, $storeSyncPut->status());
        $this->assertTrue(property_exists($response, 'body'));
    }
}