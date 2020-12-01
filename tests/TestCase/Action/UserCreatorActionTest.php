<?php

namespace App\Test\TestCase\Action;

use App\Domain\User\Repository\UserCreatorRepository;
use App\Test\Traits\AppTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test.
 */
class UserCreatorActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test.
     *
     * @return void
     */
    public function testUserCreateAction(): void
    {
        // Mock the repository resultset
        $this->mock(UserCreatorRepository::class)->method('insertUser')->willReturn(1);

        // Create request with method and url
        $data = [
            'username' => 'sally',
            'email' => 'sally@example.com',
        ];

        $request = $this->createRequest('POST', '/users')->withParsedBody($data);

        // Make request and fetch response
        $response = $this->app->handle($request);

        // Asserts
        $this->assertSame(201, $response->getStatusCode());
    }
}
