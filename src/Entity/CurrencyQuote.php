<?php

namespace App\Entity;

use App\Exchange\Currency;
use App\Repository\CurrencyQuoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CurrencyQuoteRepository::class)]
final readonly class CurrencyQuote
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    public Uuid $id;

    public function __construct(
        #[ORM\ManyToOne(inversedBy: Import::class)]
        public Import $import,

        #[ORM\Column(length: 5)]
        public Currency $base,

        #[ORM\Column(length: 5)]
        public Currency $quote,

        #[ORM\Column(type: Types::FLOAT)]
        public float $rate,
    ) {
        $this->id = Uuid::v7();
    }
}
