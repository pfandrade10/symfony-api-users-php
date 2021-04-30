<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class GetUserActionTest extends TestCase
{
    public function test_get_user_should_return_200(): void
    {
        // Assign
        $user = new User();
        $user->setFirstName('Teste');
        $user->setLastName('Teste');
        $user->setEmail('teste@teste.com');
        $this->em->persist($user);
        $this->em->flush();

        // Act
        $this->client->request(method: 'GET', uri: '/users/1');
        $statusCode = $this->client->getResponse()->getStatusCode();

        // Assert
        $this->assertSame(Response::HTTP_OK, $statusCode);
    }

    public function test_get_user_should_return_404(): void
    {
        // Act
        $this->client->request(method: 'GET', uri: '/users/999');
        $statusCode = $this->client->getResponse()->getStatusCode();
        
        // Assert
        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
