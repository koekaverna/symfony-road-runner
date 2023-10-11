<?php

declare(strict_types=1);

namespace App\Exchange\Provider;

use App\Exchange\CurrencyPair;

interface ProviderInterface
{
    public function getExchangeRate(CurrencyPair $currencyPair): float;
}
