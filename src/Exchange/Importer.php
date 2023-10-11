<?php

declare(strict_types=1);

namespace App\Exchange;

use App\Exchange\Importer\ImporterInterface;
use App\Exchange\Provider\BatchProviderInterface;
use App\Exchange\Provider\ProviderInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

final class Importer
{
    /**
     * @param iterable<BatchProviderInterface|ProviderInterface> $providers
     * @param iterable<ImporterInterface> $importers
     */
    public function __construct(
        #[TaggedIterator('app.exchange.provider')]
        private iterable $providers,
        #[TaggedIterator('app.exchange.importer')]
        private iterable $importers,
    ) {
    }

    public function import(Currency $baseCurrency): void
    {
        foreach ($this->providers as $provider) {
            if ($provider instanceof BatchProviderInterface) {
                $currencies = $provider->getEnabledCurrencies();
                $rates = $provider->getExchangeRates($baseCurrency, $currencies);

                foreach ($this->importers as $importer) {
                    // TODO: this code doesn't work with multiple importers because
                    //       the first importer will get all the rates from generator
                    $importer($provider::class, $baseCurrency, $rates);
                }
            }
        }
    }
}
