<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserAction
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    #[Route("/users/{id}", name: "user_delete", methods: ["DELETE"])]
    public function __invoke(int $id): Response
    {
        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->find($id);

        if (null === $user) {
            return new JsonResponse([
                'error' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
