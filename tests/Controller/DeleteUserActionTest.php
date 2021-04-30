<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

final class DeleteUserActionTest extends TestCase
{
    public function test_delete_user_should_return_no_content(): void
    {
        // Assign
        $user = new User();
        $user->setFirstName('Teste');
        $user->setLastName('Teste');
        $user->setEmail('teste@teste.com');
        $this->em->persist($user);
        $this->em->flush();

        // Act
        $this->client->request(method: 'DELETE', uri: '/users/1');
        $statusCode = $this->client->getResponse()->getStatusCode();

        // Assert
        $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
    }

    public function test_delete_user_with_invalid_id(): void
    {
        // Act
        $this->client->request(method: 'DELETE', uri: '/users/999');
        $statusCode = $this->client->getResponse()->getStatusCode();

        // Assert
        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
