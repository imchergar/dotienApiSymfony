<?php

namespace App\Controller;

use App\Dto\RegisterUserDto;
use App\Entity\User;
use App\Service\RegisterUserHandler;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use OpenApi\Attributes as OA;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
class RegisterController extends AbstractController
{
    #[Route('api/register', name: 'user_register', methods: ['POST'])]
    #[OA\Post(
        path: '/api/register',
        summary: 'Register a new user',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email'),
                    new OA\Property(property: 'password', type: 'string', format: 'password'),
                ]
            )
        ),
        tags: ['User'],
        responses: [
            new OA\Response(response: 201, description: 'User created successfully'),
            new OA\Response(response: 400, description: 'Validation failed'),
        ]
    )]
    #[OA\Tag(name: 'Authentication')]
    public function __invoke(
        Request $request,
        ValidatorInterface $validator,
        RegisterUserHandler $registerUserHandler
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $dto = RegisterUserDto::fromArray($data);

        $errors = $validator->validate($dto);
        if (count($errors) > 0) {
            return $this->json([
                'errors' => (string) $errors
            ], Response::HTTP_BAD_REQUEST);
        }

        $registerUserHandler->handle($dto);

        return $this->json([
            'message' => 'User created successfully'
        ], Response::HTTP_CREATED);
    }
}
