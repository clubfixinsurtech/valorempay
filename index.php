<?php

require_once __DIR__ . '/vendor/autoload.php';

##############################
## SETUP
##############################

$clientId = '';
$clientSecret = '';

$connector = new \ValoremPay\ValoremPayConnector(clientId: $clientId, clientSecret: $clientSecret);
$valoremPay = $connector->valoremPay();

##############################
## [x] POST transactions
##############################

$createTransaction = $valoremPay->createTransaction();
$nit = $createTransaction->object()->payment->nit;

//dump($createTransaction, $createTransaction->object());

##############################
## [x] GET transaction
##############################

//$getTransaction = $valoremPay->getTransaction(nit: $nit);

//dd($getTransaction->object());

##############################
## [x] POST payments{nit}
##############################

//$card = new \ValoremPay\ValueObjects\Card(number: '5448280000000007', expiryDate: '0128', securityCode: '123');
//$createPayment = $valoremPay->createPayment(nit: $nit, card: $card);

//dd($createPayment->object());

##############################
## [] PUT payments{nit}
##############################

$confirmPayment = $valoremPay->confirmPayment(nit: $nit); // TODO: Check if this is working

dump($confirmPayment, $confirmPayment->object());

##############################
## [] POST cancellations
##############################

$createCancellation = $valoremPay->createCancellation(nit: $nit); // TODO: Check if this is working

dump($createCancellation, $createCancellation->object());

##############################
## [] PUT cancellations
##############################

$confirmCancellation = $valoremPay->confirmCancellation(nit: $nit); // TODO: Check if this is working

dump($confirmCancellation, $confirmCancellation->object());

##############################
## [x] POST store-sync
##############################

//$storeSync = $valoremPay->storeSync(merchantUsn: '123456', customerId: '123456789');
//$nita = $storeSync->object()->body->nita;
//$storeToken = $storeSync->object()->body->store_token;

//dd($storeSync, $storeSync->object());

##############################
## [x] PUT store-sync
##############################

//$storeSyncPut = $valoremPay->storeSyncPut(nita: $nita, storeToken: $storeToken);

//dd($storeSyncPut->object());

