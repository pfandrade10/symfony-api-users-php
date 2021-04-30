<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Validator\ConstraintViolationListInterface;

class CreateUserAction
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private RouterInterface $router,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    )
    {
    }

    #[Route("/users", methods: ["POST"])]
    public function __invoke(Request $request): Response
    {
        $user = $this->serializer->deserialize($request->getContent(), User::class, 'json');

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

        return new JsonResponse([
          'status' => 'ok'
        ], Response::HTTP_CREATED, [
            'Location' => $this->router->generate('user_get', [
                'id' => $user->getId()
            ])
        ]);
    }
}
