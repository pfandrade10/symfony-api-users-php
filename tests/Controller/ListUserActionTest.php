<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ListUserActionTest extends TestCase
{
    public function test_list_user_should_return_200(): void
    {
        // Assign
        $user = new User();
        $user->setFirstName('Teste');
        $user->setLastName('Teste');
        $user->setEmail('teste@teste.com');
        $this->em->persist($user);
        $this->em->flush();

        // Act
        $this->client->request(method: 'GET', uri: '/users');
        $statusCode = $this->client->getResponse()->getStatusCode();

        // Assert
        $this->assertSame(Response::HTTP_OK, $statusCode);
    }
}
