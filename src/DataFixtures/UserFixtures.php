<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher = $passwordHasher;
    }

    public const USERS = [
        [
            'email' => 'john.doe@gmail.com',
            'pseudo' => 'John Doe',
            'password' => 'contributor',
            'roles' => ['ROLE_CONTRIBUTOR'],
        ],
        [
            'email' => 'nathanlebg@gmail.com',
            'pseudo' => 'Nathan Chapelle',
            'password' => 'admin',
            'roles' => ['ROLE_ADMIN'],
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $user) {
            $newUser = new User();
            $newUser->setEmail($user['email']);
            $newUser->setPseudo($user['pseudo']);
            $newUser->setPassword($this->passwordHasher->hashPassword($newUser, $user['password']));
            $newUser->setRoles($user['roles']);
            $manager->persist($newUser);
        }
        

        $manager->flush();
    }
}
