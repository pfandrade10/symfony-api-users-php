<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetUserAction
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer
    )
    {
    }

    #[Route("/users/{id}", name: "user_get", methods: ["GET"])]
    public function __invoke(int $id): Response
    {
        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->find($id);

        if (null === $user) {
            return new JsonResponse([
                'error' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return JsonResponse::fromJsonString($this->serializer->serialize($user, 'json'));
    }
}
