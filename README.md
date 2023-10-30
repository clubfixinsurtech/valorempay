# Valorem Pay @ClubFix

[![Maintainer](http://img.shields.io/badge/maintainer-@clubfixinsurtech-blue.svg?style=flat-square)](https://twitter.com/WilderAmorim)
[![Source Code](http://img.shields.io/badge/source-clubfixinsurtech/valorempay-blue.svg?style=flat-square)](https://github.com/clubfixinsurtech/valorempay)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/clubfixinsurtech/valorempay.svg?style=flat-square)](https://packagist.org/packages/clubfixinsurtech/valorempay)
[![Latest Version](https://img.shields.io/github/release/clubfixinsurtech/valorempay.svg?style=flat-square)](https://github.com/clubfixinsurtech/valorempay/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/clubfixinsurtech/valorempay.svg?style=flat-square)](https://scrutinizer-ci.com/g/clubfixinsurtech/valorempay)
[![Quality Score](https://img.shields.io/scrutinizer/g/clubfixinsurtech/valorempay.svg?style=flat-square)](https://scrutinizer-ci.com/g/clubfixinsurtech/valorempay)
[![Total Downloads](https://img.shields.io/packagist/dt/clubfixinsurtech/valorempay.svg?style=flat-square)](https://packagist.org/packages/clubfixinsurtech/valorempay)

###### Integration with the ValoremPay payment gateway.

Integração com o Gateway de Pagamento Valorem Pay.

### Highlights

- Simple installation (Instalação simples)
- Composer ready and PSR-2 compliant (Pronto para o composer e compatível com PSR-2)

### Available services

* Criação de transação
* Efetivação de Pagamento
* Confirmação de Pagamento
* Criação de Cancelamento
* Efetivação do Cancelamento
* Armazenamento do Cartão de Crédito
* Envio do Cartão a ser Armazenado
* Consulta da Transação

## Installation

Valorem Pay is available via Composer:

```bash
composer require clubfixinsurtech/valorempay
```

## Documentation

###### For more details on how to use it, see the "examples" folder in the component's directory. It contains an example of how to use the class. It works as follows:

Para obter mais detalhes sobre como utilizar, consulte a pasta "examples" no diretório do componente. Nela, haverá um exemplo de utilização da classe. O funcionamento é o seguinte:

##### Basic Usage:

```php
<?php

$clientId = '';
$clientSecret = '';

$connector = new \ValoremPay\ValoremPayConnector(clientId: $clientId, clientSecret: $clientSecret);

// Create transaction
$request = $connector->valoremPay()->createTransaction([
    'installments' => 1,
    'installment_type' => 4,
    'amount' => 1000,
    'soft_descriptor' => 'Lorem ipsum dolor',
    'additional_data' => [
        'status_notification_url' => 'https://example.com',
        'use_decision_manager' => false,
        'postpone_confirmation' => false,
    ],
]));
$response = $request->object();

dump($request, $response);
```

## Credits

- [Clubfix](https://clubfix.com.br) (Team)

## License

The MIT License (MIT). Please see [License File](https://github.com/clubfixinsurtech/valorempay/blob/master/LICENSE) for more information.