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
     * @dataProvider provideUserReaderAction
     *
     * @param UserData $user The user
     *
     * @return void
     */
    public function testUserReaderAction(UserData $user): void
    {
        // Mock the repository resultset
        $this->mock(UserReaderRepository::class)->method('getUserById')->willReturn($user);

        $request = $this->createRequest('GET', '/users/1');
        $response = $this->app->handle($request);

        $this->assertSame(200, $response->getStatusCode());

        $this->assertJsonData(
            $response,
            [
                'user_id' => 1,
                'username' => 'admin',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
            ]
        );
    }

    /**
     * Provider.
     *
     * @return array The data
     */
    public function provideUserReaderAction(): array
    {
        $user = new UserData();
        $user->id = 1;
        $user->username = 'admin';
        $user->email = 'john.doe@example.com';
        $user->firstName = 'John';
        $user->lastName = 'Doe';

        return [
            'User' => [
                $user
            ]
        ];
    }
}
