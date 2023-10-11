<?php

namespace App\Repository;

use App\Entity\CurrencyQuote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CurrencyQuote>
 *
 * @method CurrencyQuote|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyQuote|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyQuote[]    findAll()
 * @method CurrencyQuote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyQuoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencyQuote::class);
    }

//    /**
//     * @return CurrencyQuote[] Returns an array of CurrencyQuote objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CurrencyQuote
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
