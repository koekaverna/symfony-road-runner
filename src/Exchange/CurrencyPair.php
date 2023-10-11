<?php

declare(strict_types=1);

namespace App\Exchange;

final readonly class CurrencyPair
{
    public function __construct(
        public Currency $baseCurrency,
        public Currency $quoteCurrency
    ) {
    }
}
