<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserReaderResult;
use App\Domain\User\Repository\UserReaderRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class UserReader
{
    /**
     * @var UserReaderRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserReaderRepository $repository The repository
     */
    public function __construct(UserReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a user by the given user id.
     *
     * @param int $userId The user id
     *
     * @throws ValidationException
     *
     * @return UserReaderResult The user data
     */
    public function getUserDetails(int $userId): UserReaderResult
    {
        // Input validation
        if (empty($userId)) {
            throw new ValidationException('User ID required');
        }

        $userRow = $this->repository->getUserById($userId);

        // Optional: Do something complex here...

        // Map array to data object
        $user = new UserReaderResult();
        $user->id = (int)$userRow['id'];
        $user->username = (string)$userRow['username'];
        $user->firstName = (string)$userRow['first_name'];
        $user->lastName = (string)$userRow['last_name'];
        $user->email = (string)$userRow['email'];

        return $user;
    }
}