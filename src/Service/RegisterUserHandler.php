<?php

namespace App\Service;

use App\Dto\RegisterUserDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserHandler
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher
    ) {}

    public function handle(RegisterUserDto $dto): User
    {
        $user = new User();
        $user->setEmail($dto->email);
        $user->setPassword(
            $this->hasher->hashPassword($user, $dto->password)
        );
        $user->setPhoneNumber($dto->phoneNumber);
        $user->setFirstName($dto->firstName);
        $user->setLastName($dto->lastName);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}