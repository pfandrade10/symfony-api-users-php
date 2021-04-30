<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class UpdateUserAction
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator
    )
    {
    }

    #[Route("/users/{id}", methods: ["PUT"])]
    public function __invoke(int $id, Request $request): Response
    {
        $requestContent = json_decode($request->getContent(), true);

        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->find($id);

        if (null === $user) {
            return new JsonResponse([
                'error' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->setFirstName($requestContent['firstName']);
        $user->setLastName($requestContent['lastName']);
        $user->setEmail($requestContent['email']);

        $errors = $this->validator->validate($user);

        if (count($errors) > 0) {
            $violations = array_map(function(ConstraintViolationInterface $violation) {
                return [
                    'path' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage()
                ];
            }, iterator_to_array($errors));
  
            $response = [
                'error' => 'As informações enviadas estão incorretas',
                'violations' => $violations
            ];
  
            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
