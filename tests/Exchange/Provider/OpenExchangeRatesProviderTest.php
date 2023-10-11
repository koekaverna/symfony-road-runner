<?php

declare(strict_types=1);

namespace App\Tests\Exchange\Provider;

use App\Exchange\Currency;
use App\Exchange\Provider\CurrencyLayer\CurrencyLayerProvider;
use App\Exchange\Provider\OpenExchangeRates\OpenExchangeRatesProvider;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\HttpClient;

final class OpenExchangeRatesProviderTest extends BatchProviderTestCase
{
    public function testGetExchangeRate(): void
    {
        $client = HttpClient::create();
        $logger = new NullLogger();
        $provider = new OpenExchangeRatesProvider($client, $logger);

        $currencies = [Currency::EUR, Currency::RUB];
        $result = $provider->getExchangeRates(Currency::USD, $currencies);

        self::assertBatchProviderResult($result, Currency::USD, $currencies);
    }
}
