<?php

namespace App\Repository;

use App\Entity\DailyForecast;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DailyForecast|null find($id, $lockMode = null, $lockVersion = null)
 * @method DailyForecast|null findOneBy(array $criteria, array $orderBy = null)
 * @method DailyForecast[]    findAll()
 * @method DailyForecast[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DailyForecastRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DailyForecast::class);
    }

    // /**
    //  * @return DailyForecast[] Returns an array of DailyForecast objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DailyForecast
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
