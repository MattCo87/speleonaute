<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new User();

        $user   ->setEmail('true@test.com')
                ->setPassword('password')
                ->setPseudo('pseudo')
                ->setReputation(15);
    
        $this->assertTrue($user->getEmail() === 'true@test.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getPseudo() === 'pseudo');
        $this->assertTrue($user->getReputation() === 15);
    }

    public function testIsFalse()
    {
        $user = new User();

        $user   ->setEmail('true@test.com')
                ->setPassword('password')
                ->setPseudo('pseudo')
                ->setReputation(15);

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getPseudo() === 'false');
        $this->assertFalse($user->getReputation() === 10);
    }

    public function testIsEmpty()
    {
        $user = new User();

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getPseudo());
        $this->assertEmpty($user->getReputation());
    }



}
