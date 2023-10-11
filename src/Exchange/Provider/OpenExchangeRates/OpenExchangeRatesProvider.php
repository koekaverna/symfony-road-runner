<?php

declare(strict_types=1);

namespace App\Exchange\Provider\OpenExchangeRates;

use App\Exchange\Currency;
use App\Exchange\CurrencyPair;
use App\Exchange\Exception\InvalidResponseException;
use App\Exchange\Provider\BatchProviderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class OpenExchangeRatesProvider implements BatchProviderInterface
{
    private const API_URL = 'https://openexchangerates.org/api/latest.json';
    public function __construct(
        private HttpClientInterface $client,
        private LoggerInterface $logger,
        private string $apiKey = '674f30f68a144088b6193482e39504d5',
    ) {
    }

    public function getExchangeRates(Currency $currency, array $currencies): iterable
    {
        if ($currencies === []) {
            return;
        }

        $response = $this->client->request('GET', self::API_URL, [
            'query' => [
                'app_id' => $this->apiKey,
                'base' => $currency->value,
                'symbols' => implode(',', array_map(fn(Currency $currency) => $currency->value, $currencies)),
            ],
        ]);

        $content = $response->toArray();
        if (!\is_array($content['rates'])) {
            $this->logger->error('Invalid response from OpenExchangeRates.', [
                'response' => $content,
            ]);

            throw new InvalidResponseException('Invalid response from OpenExchangeRates.');
        }

        foreach ($content['rates'] as $key => $rate) {
            $currencyPair = new CurrencyPair(
                baseCurrency: $currency,
                quoteCurrency: Currency::from($key),
            );
            yield $currencyPair => $rate;
        }
    }

    public function getEnabledCurrencies(): array
    {
        return [];
    }
}
