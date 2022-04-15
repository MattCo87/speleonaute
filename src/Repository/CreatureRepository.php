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

use App\Entity\CreatureFormation;
use App\Entity\Formation;
use App\Entity\Statistique;
use App\Entity\Modele;
use App\Entity\StrategieModele;
use App\Entity\Strategie;
use App\Entity\ActionStrategie;
use App\Entity\Action;
use App\Entity\StatistiqueModele;

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
        $this->emsm = new StatistiqueModeleRepository($registry);
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
        $alea = rand(0, 9999);
        $nom_modele = $modele->getNomModele();
        $nom_modele = $nom_modele . " #" . $alea;

        $creature->setNom($nom_modele);
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
        $alea = rand(0, 999);
        $nom_modele = $modele->getNomModele();
        $nom_modele = $nom_modele . " #" . $alea;
        $creature->setNom($nom_modele);
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
            $statistiqueCreature->setValeur(floor(($stat->getValeurMin() + $stat->getValeurMax() / 2)));

            $manager->persist($statistiqueCreature);
        }
        $manager->flush();

        return $creature;
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
            ->getQuery()
            ->getArrayResult();
    }

    public function getFormationCreatures2($var_user_id): ?array
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->leftJoin(CreatureFormation::class, 'cf')
            ->leftJoin(Formation::class, 'f')
            ->where('cf.lienCreature = c.id')
            ->andwhere('f.id = cf.lienFormation')
            ->andwhere("f.id = ?1")
            ->setParameter(1, $var_user_id)
            ->getQuery()
            ->getArrayResult();
    }

    public function getStatsCreatures(int $creatureId): ?array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin(StatistiqueCreature::class, 'statc', 'WITH', 'statc.lienStatistique = stat.id')
            ->leftJoin(Statistique::class, 'stat')
            ->select('c.nom', 'statc.valeur', 'stat.nom')
            ->where("c.id = :creatureId")
            ->andwhere('statc.lienCreature = :creatureId')
            ->setParameter('creatureId', $creatureId)
            ->getQuery()
            ->getArrayResult();
    }


    public function getActionsCreatures(int $creatureId): ?array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin(Modele::class, 'mod', 'WITH', 'mod.id = c.lienModele')
            ->leftJoin(StrategieModele::class, 'smod', 'WITH', 'smod.lienModele = mod.id')
            ->leftJoin(Strategie::class, 'strat', 'WITH', 'strat.id = smod.lienStrategie')
            ->leftJoin(ActionStrategie::class, 'actstrat', 'WITH', 'actstrat.lienStrategie = strat.id')
            ->leftJoin(Action::class, 'act', 'WITH', 'act.id = actstrat.lienAction')
            ->select('c.nom', 'mod.nomModele', 'mod.rarete', 'mod.pointNiv', 'mod.ouvrable', 'smod.positionStrategie', 'strat.nom', 'actstrat.positionAction', 'act.nom', 'act.toucher', 'act.degat', 'act.tier')
            ->distinct()
            ->where("c.id = :creatureId")
            ->setParameter('creatureId', $creatureId)
            ->getQuery()
            ->getArrayResult();
    }

    public function findByUser($id_user)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT *
        FROM creature c
        WHERE c.lien_user_id = :id_user
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id_user' => $id_user]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
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
