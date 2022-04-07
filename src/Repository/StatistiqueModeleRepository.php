<?php

namespace App\Repository;

use App\Entity\StatistiqueModele;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatistiqueModele|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatistiqueModele|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatistiqueModele[]    findAll()
 * @method StatistiqueModele[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatistiqueModeleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatistiqueModele::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(StatistiqueModele $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(StatistiqueModele $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return StatistiqueModele[] Returns an array of StatistiqueModele objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatistiqueModele
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
