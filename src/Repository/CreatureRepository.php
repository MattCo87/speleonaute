<?php

namespace App\Repository;

use App\Entity\Creature;
use App\Entity\StatistiqueCreature;
use App\Repository\StatistiqueModeleRepository;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Creature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Creature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Creature[]    findAll()
 * @method Creature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatureRepository extends ServiceEntityRepository
{
    private $emsm;

    public function __construct(ManagerRegistry $registry, StatistiqueModeleRepository $emsm)
    {
        parent::__construct($registry, Creature::class);
        $this->emsm = $emsm;
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


    public function makeCreature($modele)
    {
        $manager = $this->getEntityManager();

        // On crée une nouvelle creature
        $creature = new Creature();

        // On rempli son identité
        $creature->setNom('new_' . $modele->getNomModele());
        $creature->setNiveau(1);
        $creature->setExp(0);
        $creature->setLienModele($modele);
        $manager->persist($creature);

        // On récupére toutes les statistiques du modèle
        $statistiqueModele = $this->emsm->findBy(['lienModele' => $modele->getId()]);

        // On ajoute chaque statistique à la créature
        foreach ($statistiqueModele as $stat) {
            $statistiqueCreature = new StatistiqueCreature();

            $statistiqueCreature->setLienCreature($creature);
            $statistiqueCreature->setLienStatistique($stat->getLienStatistique());
            $statistiqueCreature->setValeur(rand($stat->getValeurMin(), $stat->getValeurMax()));

            $manager->persist($statistiqueCreature);
        }
        $manager->flush();

        return $creature;
    }

    public function makeMonstre($modele)
    {
        $manager = $this->getEntityManager();

        // On crée une nouvelle creature
        $creature = new Creature();

        // On rempli son identité
        $creature->setNom('new_' . $modele->getNomModele());
        $creature->setNiveau(1);
        $creature->setExp(0);
        $creature->setLienModele($modele);
        $manager->persist($creature);

        // On récupére toutes les statistiques du modèle
        $statistiqueModele = $this->emsm->findBy(['lienModele' => $modele->getId()]);

        // On ajoute chaque statistique à la créature
        foreach ($statistiqueModele as $stat) {
            $statistiqueCreature = new StatistiqueCreature();

            $statistiqueCreature->setLienCreature($creature);
            $statistiqueCreature->setLienStatistique($stat->getLienStatistique());
            $statistiqueCreature->setValeur(floor(($stat->getValeurMin() + $stat->getValeurMax()/2)));

            $manager->persist($statistiqueCreature);
        }
        $manager->flush();

        return $creature;
    }

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
