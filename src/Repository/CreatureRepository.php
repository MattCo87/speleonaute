<?php

namespace App\Repository;

use App\Entity\Creature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\CreatureFormation;
use App\Entity\Formation;
use App\Entity\Statistique;
use App\Entity\StatistiqueCreature;

/**
 * @method Creature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Creature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Creature[]    findAll()
 * @method Creature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Creature::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Creature $entity, bool $flush = true): void
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
    public function remove(Creature $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getFormationCreatures($formation): ?array
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->leftJoin(CreatureFormation::class, 'cf')
            ->leftJoin(Formation::class, 'f')
            ->where('cf.lienCreature = c.id')
            ->andwhere('f.id = cf.lienFormation')
            ->andwhere("f.nom = ?1")
            ->setParameter(1, $formation)
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult();
    }

    public function getInfosCreatures($creatureId): ?array
    {
        return $this->createQueryBuilder('c')
            ->select('c',)
            ->leftJoin(StatistiqueCreature::class, 'statc')
            ->leftJoin(Statistique::class, 'stat')
            ->leftJoin(Statistique::class, 'stat')
            ->where('cf.lienCreature = c.id')
            ->andwhere('f.id = cf.lienFormation')
            ->andwhere("f.nom = :")
            ->setParameter(1, $formation)
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult();
    }

    //    ->where('s.campaign = :campaign')
    //    ->setParameter('campaign', $campaign)

    /**
     * @return Creature[] Returns an array of Creature objects
     */



    // // Exemple d'Adeline
    //public function findThresHoldReturn(Session $session, string $locale): array
    //{
    //$qb = $this->createQueryBuilder('cp')
    //->select('AVG(cp.percentage) AS avg, sc.ulid, sct.name')
    //->leftJoin('cp.skillChild', 'sc')
    //->leftJoin('sc.translations', 'sct')
    //->leftJoin('cp.participant', 'p')
    //->andWhere('cp.session = :session')
    //->andWhere('sct.locale = :locale')
    //->andWhere('p.state = :state_done')
    //->setParameter('session', $session)
    //->setParameter('locale', $locale)
    //->setParameter('state_done', ParticipantState::STATE_DONE)
    //->groupBy('sc.ulid, sct.name')
    //->orderBy('sc.sort', 'ASC')
    //;
    //
    //return $qb->getQuery()->getResult();
    //}
    //
    // /**
    //  * @return Creature[] Returns an array of Creature objects
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
    public function findOneBySomeField($value): ?Creature
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
