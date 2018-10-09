# Kobas Provider for OAuth 2.0 Client
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

This package provides Kobas OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

If you are doing an integration for Kobas it's more likely you want our [API Client](https://github.com/KOBASSoftware/api-client-php) which uses this library.

## Installation

To install, use composer:

```
composer require kobas/oauth2-kobas
```

## Usage

Usage is the same as The League's OAuth client, using `\Kobas\OAuth2\Client\Provider\Kobas` as the provider.

### Authorization Code Flow

```php
$provider = new Kobas\OAuth2\Client\Provider\Kobas([
    'clientId'          => '{kobas-client-id}',
    'clientSecret'      => '{kobas-client-secret}',
    'companyId'         => '{kobas-company-id}',
]);

$accessToken = $provider->getAccessToken('client_credentials', ['scope' => 'integration']);

```

## Testing

``` bash
$ ./vendor/bin/phpunit
```


The MIT License (MIT). Please see [License File](https://github.com/kobas/oauth2-kobas/blob/master/LICENSE) for more information.