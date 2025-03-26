<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDto
{
    #[Assert\NotBlank(message: "Email cannot be empty.")]
    #[Assert\Email(message: "Please enter a valid email address.")]
    public string $email;

    #[Assert\NotBlank(message: "Password cannot be empty.")]
    #[Assert\Length(
        min: 8,
        minMessage: "Password must be at least 8 characters long."
    )]
    public string $password;

    #[Assert\NotBlank(message: "Phone number cannot be empty.")]
    #[Assert\Regex(
        pattern: "/^\+?[0-9]{8,15}$/",
        message: "Please enter a valid phone number (only digits, with an optional leading +)."
    )]
    public string $phoneNumber;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50, maxMessage: 'First name needs to be 50 chars or less')]
    public string $firstName;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50, maxMessage: 'Last name needs to be 50 chars or less')]
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