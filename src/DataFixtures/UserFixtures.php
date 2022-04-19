<?php

namespace App\DataFixtures;

use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{

    public function getOrder()
    {
        return 1;
    }

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Client administrator account
        $admin = new User();
        $admin->setPseudo('Mr X')
            ->setEmail('8gfhf7700p@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setReputation(1000);
        $password = $this->hasher->hashPassword($admin, 'pass_1234');
        $admin->setPassword($password);

        $manager->persist($admin);

        $this->addReference('admin', $admin);


        $users = array(
            "USER_Admin" => array(
                "pseudo" => "admin", "mail" => "admin@gmail.com", "role" => "ROLE_ADMIN", "xp" => 1, "monnaie" => 1
            ),
            "USER_Joueur" => array(
                "pseudo" => "joueur", "mail" => "joueur@gmail.com", "role" => "ROLE_USER", "xp" => 1000, "monnaie" => 1000
            ),
            "USER_Yanis" => array(
                "pseudo" => "callipo", "mail" => "callipo@gmail.com", "role" => "ROLE_USER", "xp" => 1, "monnaie" => 1
            ),
            "USER_Pierrette" => array(
                "pseudo" => "piepie", "mail" => "piepie@gmail.com", "role" => "ROLE_USER", "xp" => 1, "monnaie" => 1
            ),
            "USER_Paulette" => array(
                "pseudo" => "paully", "mail" => "paully@gmail.com", "role" => "ROLE_USER", "xp" => 1, "monnaie" => 1
            ),
            "USER_Jacqueline" => array(
                "pseudo" => "jaki", "mail" => "jaki@gmail.com", "role" => "ROLE_USER", "xp" => 1, "monnaie" => 1
            ),
        );


        foreach ($users as $name => $user) {
            // Client user accounts
            $$name = new User();
            $$name->setPseudo($user['pseudo'])
                ->setEmail($user['mail'])
                ->setRoles([$user['role']])
                ->setReputation($user['xp'])
                ->setMonnaie($user['monnaie']);
            $password = $this->hasher->hashPassword($$name, 'pass_1234');
            $$name->setPassword($password);
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dd("Jusqu'ici tout va bien");
        }
        $manager->flush();
    }
}
