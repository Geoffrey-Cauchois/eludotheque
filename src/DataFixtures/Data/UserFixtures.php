<?php

namespace App\DataFixtures\Data;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;
    private string $defaultPassword;

    public function __construct(string $defaultPassword, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->defaultPassword = $defaultPassword;
        $this->passwordHasher = $passwordHasher;
    }

    public function load(): void
    {
            $user = new User();
            $user->setEmail('user@mail.mail');
            $user->setUsername('user');
            $user->setPassword($this->passwordHasher->hashPassword($user, $this->defaultPassword));
            
            $this->entityManager->persist($user);
            $this->entityManager->flush();
    }
}