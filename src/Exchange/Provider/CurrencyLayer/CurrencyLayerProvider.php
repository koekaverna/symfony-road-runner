<?php

declare(strict_types=1);

namespace App\Exchange\Provider\CurrencyLayer;

use App\Exchange\Currency;
use App\Exchange\CurrencyPair;
use App\Exchange\Exception\InvalidResponseException;
use App\Exchange\Provider\BatchProviderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class CurrencyLayerProvider implements BatchProviderInterface
{
    private const API_URL = 'https://api.currencylayer.com/live';

    public function __construct(
        private HttpClientInterface $client,
        private LoggerInterface $logger,
        private string $apiKey = '1e417e802b512c2a1fe8ec00f3085eb9',
        private array $enabledCurrencies = [Currency::USD, Currency::EUR, Currency::RUB],
    ) {
    }

    public function getExchangeRates(Currency $currency, array $currencies): iterable
    {
        if ($currencies === []) {
            return;
        }

        $response = $this->client->request('GET', self::API_URL, [
            'query' => [
                'access_key' => $this->apiKey,
                'source' => $currency->value,
                'currencies' => implode(',', array_map(fn(Currency $currency) => $currency->value, $currencies)),
            ],
        ]);

        $content = $response->toArray();
        if ($content['success'] === false || !\is_array($content['quotes'])) {
            $this->logger->error('Invalid response from API Layer.', [
                'response' => $content,
            ]);

            throw new InvalidResponseException('Invalid response from API Layer.');
        }

        foreach ($content['quotes'] as $key => $rate) {
            $quoteCurrency = substr($key, \strlen($currency->value));
            $currencyPair = new CurrencyPair(
                baseCurrency: $currency,
                quoteCurrency: Currency::from($quoteCurrency),
            );

            yield $currencyPair => $rate;
        }
    }

    public function getEnabledCurrencies(): array
    {
        return $this->enabledCurrencies;
    }
}
