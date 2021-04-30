<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserActionTest extends TestCase
{
    public function test_update_user(): void
    {
        $user = new User();
        $user->setFirstName('Teste');
        $user->setLastName('Teste');
        $user->setEmail('teste@teste.com');
        $this->em->persist($user);
        $this->em->flush();

        
        $this->client->request(method: 'PUT', uri: '/users/1', content: json_encode([
            'firstName' => 'Teste2',
            'lastName' => 'Teste2',
            'email' => 'teste2@teste.com',
        ]));
        $statusCode = $this->client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
    }

    public function test_update_user_with_invalid_data(): void
    {
        $user = new User();
        $user->setFirstName('Teste');
        $user->setLastName('Teste');
        $user->setEmail('teste@teste.com');
        $this->em->persist($user);
        $this->em->flush();

        $this->client->request(method: 'PUT', uri: '/users/1', content: json_encode([
            'firstName' => 'Teste2',
            'lastName' => 'Teste2',
            'email' => 'teste2@.com',
        ]));
        $statusCode = $this->client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_BAD_REQUEST, $statusCode);
    }

    public function test_update_user_with_invalid_user_id(): void
    {
        $user = new User();
        $user->setFirstName('Teste');
        $user->setLastName('Teste');
        $user->setEmail('teste@teste.com');
        $this->em->persist($user);
        $this->em->flush();

        $this->client->request(method: 'PUT', uri: '/users/999', content: json_encode([
            'firstName' => 'Teste2',
            'lastName' => 'Teste2',
        ]));
        $statusCode = $this->client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
