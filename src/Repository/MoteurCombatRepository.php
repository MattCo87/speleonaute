<?php
/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repository;

use App\Entity\Action;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @ORM\Entity(repositoryClass="MyDomain\Model\UserRepository")
 */

class MoteurCombatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Action::class);
    }


    /**
     * @return Product[]
     */
    public function FindTierSup(int $tiermin): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
            FROM App\Entity\Action a
            WHERE a.tier >= :$tiermin
            ORDER BY a.tier ASC'
        )->setParameter('tiermin', $tiermin);

        // returns an array of Product objects
        return $query->getResult();
    }
}
