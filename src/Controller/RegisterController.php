<?php

namespace App\Controller;

use App\Dto\RegisterUserDto;
use App\Service\RegisterUserHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use OpenApi\Attributes as OA;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
class RegisterController extends AbstractController
{
    const USER_CREATED_SUCCESSFULLY = 'User created successfully';
    const VALIDATION_FAILED = 'Validation failed';

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
            new OA\Response(response: 201, description: self::USER_CREATED_SUCCESSFULLY),
            new OA\Response(response: 400, description: self::VALIDATION_FAILED),
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

        $user = $registerUserHandler->handle($dto);

        return $this->json([
            'user' => [
                'id'    => $user->getId(),
                'email' => $user->getEmail(),
            ],
            'message' => self::USER_CREATED_SUCCESSFULLY,
        ], Response::HTTP_CREATED);
    }
}
