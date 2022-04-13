<?php

namespace App\Repository;

use App\Entity\CreatureFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CreatureFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreatureFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreatureFormation[]    findAll()
 * @method CreatureFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatureFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreatureFormation::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CreatureFormation $entity, bool $flush = true): void
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
    public function remove(CreatureFormation $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function existCreatureFormation($tmp_formation,$tmp_creature)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT *
            FROM creature_formation cf
            WHERE cf.lien_creature_id = :id_creature
            AND cf.lien_formation_id = :id_formation
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id_creature' => $tmp_creature, 'id_formation' => $tmp_formation]);
        if($resultSet->fetchAllAssociative()){
            return 1;
        }
        else{
            return 0;
        }
    }

    // /**
    //  * @return CreatureFormation[] Returns an array of CreatureFormation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CreatureFormation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
