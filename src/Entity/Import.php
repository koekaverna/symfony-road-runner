<?php

declare(strict_types=1);

namespace App\Entity;

use App\Exchange\Currency;
use App\Repository\CurrencyQuoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CurrencyQuoteRepository::class)]
final readonly class Import
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    public Uuid $id;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    public \DateTimeInterface $createdAt;

    public function __construct(
        #[ORM\Column(length: 255)]
        public string $provider,

        #[ORM\Column(length: 5)]
        public Currency $base,
    ) {
        $this->id = Uuid::v7();
        $this->createdAt = new \DateTimeImmutable();
    }
}
