<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateUserActionTest extends WebTestCase
{
    public function test_create_user(): void
    {
        $client = static::createClient();
        $client->request(method: 'POST', uri: '/users',
            content: json_encode([
                'firstName' => 'Teste',
                'lastName' => 'Teste',
                'email' => 'teste@teste.com',
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_CREATED, $statusCode);
    }

    public function test_create_user_with_invalid_data(): void
    {
        $client = static::createClient();
        $client->request(method: 'POST', uri: '/users',
            content: json_encode([
                'firstName' => 'Teste',
                'lastName' => 'Teste',
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_BAD_REQUEST, $statusCode);
    }
}
