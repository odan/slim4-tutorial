<?php

namespace App\Test\TestCase\Action;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserReaderRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test.
 */
class UserReaderActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test.
     *
     * @return void
     */
    public function testUserReaderAction(): void
    {
        // Mock the repository resultset
        $user = new UserData();
        $user->id = 1;
        $user->username = 'admin';
        $user->email = 'john.doe@example.com';
        $user->firstName = 'John';
        $user->lastName = 'Doe';

        $this->mockMethod([UserReaderRepository::class, 'getUserById'])->willReturn($user);

        $request = $this->createRequest('GET', '/users/1');
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());

        $body = (string)$response->getBody();
        $this->assertStringContainsString(
            '{"user_id":1,"username":"admin","first_name":"John","last_name":"Doe","email":"john.doe@example.com"}',
            $body
        );
    }
}
