<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';


$clientId = '';
$clientSecret = '';
if ((!$clientId || !$clientSecret) && is_readable(__DIR__ . '/config.php')) {
    $config = include __DIR__ . '/config.php';
    $clientId = $config['client_id'];
    $clientSecret = $config['client_secret'];
}

return new \ValoremPay\ValoremPayConnector(clientId: $clientId, clientSecret: $clientSecret);
