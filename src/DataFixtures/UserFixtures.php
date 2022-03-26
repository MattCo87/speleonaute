<?php

namespace App\DataFixtures;

use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
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
        $manager->flush();

        $this->addReference('admin', $admin);


        $users = array(
            "Matt" => array(
                "pseudo" => "Lord Aixois", "mail" => "87000@gmail.com", "role" => "ROLE_USER", "xp" => 1
            ),
            "Joel" => array(
                "pseudo" => "silentfabrik", "mail" => "joel@gmail.com", "role" => "ROLE_USER", "xp" => 1
            ),
            "Yanis" => array(
                "pseudo" => "callipo", "mail" => "callipo@gmail.com", "role" => "ROLE_USER", "xp" => 1
            ),
            "Pierrette" => array(
                "pseudo" => "piepie", "mail" => "piepie@gmail.com", "role" => "ROLE_USER", "xp" => 1
            ),
            "Paulette" => array(
                "pseudo" => "paully", "mail" => "paully@gmail.com", "role" => "ROLE_USER", "xp" => 1
            ),
            "Jacqueline" => array(
                "pseudo" => "jaki", "mail" => "jaki@gmail.com", "role" => "ROLE_USER", "xp" => 1
            ),
        );


        foreach ($users as $name => $user) {
            // Client user accounts
            $$name = new User();
            $$name->setPseudo($user['pseudo'])
                ->setEmail($user['mail'])
                ->setRoles([$user['role']])
                ->setReputation($user['xp']);
            $password = $this->hasher->hashPassword($$name, 'pass_1234');
            $$name->setPassword($password);
            $manager->persist($$name);
            $manager->flush();
            $this->addReference($name, $$name);
            //dd("Jusqu'ici tout va bien");
        }
    }
}