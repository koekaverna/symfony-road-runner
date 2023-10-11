<?php

declare(strict_types=1);

namespace App\Exchange\Importer;

use App\Entity\CurrencyQuote;
use App\Entity\Import;
use App\Exchange\Currency;
use App\Exchange\CurrencyPair;
use Doctrine\ORM\EntityManagerInterface;

final class DatabaseImporter implements ImporterInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @param iterable<CurrencyPair, float> $rates
     */
    public function __invoke(string $providerName, Currency $base, iterable $rates): void
    {
        $import = new Import(
            provider: $providerName,
            base: $base,
        );

        $this->entityManager->persist($import);

        foreach ($rates as $currencyPair => $rate) {
            $quote = new CurrencyQuote(
                import: $import,
                base: $currencyPair->baseCurrency,
                quote: $currencyPair->quoteCurrency,
                rate: $rate,
            );
            $this->entityManager->persist($quote);
        }

        $this->entityManager->wrapInTransaction(fn () => $this->entityManager->flush());
    }
}
