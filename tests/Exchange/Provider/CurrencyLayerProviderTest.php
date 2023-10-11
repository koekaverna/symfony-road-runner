<?php

declare(strict_types=1);

namespace App\Tests\Exchange\Provider;

use App\Exchange\Currency;
use App\Exchange\Provider\CurrencyLayer\CurrencyLayerProvider;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\HttpClient;

final class CurrencyLayerProviderTest extends BatchProviderTestCase
{
    /**
     * @dataProvider provideCurrencies
     */
    public function testGetExchangeRate(Currency $currency, array $currencies): void
    {
        $client = HttpClient::create();
        $logger = new NullLogger();
        $provider = new CurrencyLayerProvider($client, $logger);

        $result = $provider->getExchangeRates($currency, $currencies);

        self::assertBatchProviderResult($result, $currency, $currencies);
    }

    public static function provideCurrencies(): \Generator
    {
        yield 'USD' => [Currency::USD, [Currency::EUR, Currency::RUB]];
        yield 'RUB' => [Currency::RUB, [Currency::EUR, Currency::USD]];
    }
}
