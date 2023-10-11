<?php

declare(strict_types=1);

namespace App\Exchange\Importer;

use App\Exchange\Currency;
use App\Exchange\CurrencyPair;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.exchange.importer')]
interface ImporterInterface
{
    /**
     * @param iterable<CurrencyPair, float> $rates
     */
    public function __invoke(string $providerName, Currency $base, iterable $rates): void;
}
