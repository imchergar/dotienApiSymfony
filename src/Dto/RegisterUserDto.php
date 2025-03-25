<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public string $password;

    #[Assert\NotBlank]
    public string $phoneNumber;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2)]
    public string $firstName;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2)]
    public string $lastName;

    public static function fromArray(array $data): self
    {
        $dto = new self();
        $dto->email = $data['email'] ?? '';
        $dto->password = $data['password'] ?? '';
        $dto->phoneNumber = $data['phoneNumber'] ?? '';
        $dto->firstName = $data['firstName'] ?? '';
        $dto->lastName = $data['lastName'] ?? '';

        return $dto;
    }
}