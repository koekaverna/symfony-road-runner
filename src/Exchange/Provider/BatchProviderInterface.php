<?php

declare(strict_types=1);

namespace App\Exchange\Provider;

use App\Exchange\Currency;
use App\Exchange\CurrencyPair;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.exchange.provider')]
interface BatchProviderInterface
{
    /**
     * @param array<Currency> $currencies
     *
     * @return iterable<CurrencyPair, float>
     */
    public function getExchangeRates(Currency $currency, array $currencies): iterable;

    /**
     * @return array<Currency> $currencies
     */
    public function getEnabledCurrencies(): array;
}
