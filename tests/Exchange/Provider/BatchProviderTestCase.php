<?php

declare(strict_types=1);

namespace App\Tests\Exchange\Provider;

use App\Exchange\Currency;
use PHPUnit\Framework\TestCase;

abstract class BatchProviderTestCase extends TestCase
{
    public static function assertBatchProviderResult(iterable $result, Currency $currency, array $currencies): void
    {
        $counter = 0;
        foreach ($result as $currencyPair => $rate) {
            self::assertInstanceOf(Currency::class, $currencyPair->baseCurrency);
            self::assertEquals($currency, $currencyPair->baseCurrency);
            self::assertInstanceOf(Currency::class, $currencyPair->quoteCurrency);
            self::assertIsFloat($rate);
            self::assertGreaterThan(0, $rate);

            $counter++;
        }
        self::assertEquals(\count($currencies), $counter, sprintf('Expected %d currency pairs', \count($currencies)));
    }
}
