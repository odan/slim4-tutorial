<?php

namespace App\Action;

use App\Domain\User\Service\UserReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class UserReadAction
{
    /**
     * @var UserReader
     */
    private $userReader;

    /**
     * The constructor.
     *
     * @param UserReader $userReader The user reader
     */
    public function __construct(UserReader $userReader)
    {
        $this->userReader = $userReader;
    }

    /**
     * Invoke.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array<mixed> $args The route arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args = []
    ): ResponseInterface {
        // Collect input from the HTTP request
        $userId = (int)$args['id'];

        // Invoke the Domain (application service) with inputs and keep the result
        $user = $this->userReader->getUserDetails($userId);

        // Transform the result into the JSON representation
        $result = [
            'user_id' => $user->id,
            'username' => $user->username,
            'first_name' => $user->firstName,
            'last_name' => $user->lastName,
            'email' => $user->email,
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
