<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
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
     * @return UserData The user data
     */
    public function getUserDetails(int $userId): UserData
    {
        // Validation
        if (empty($userId)) {
            throw new ValidationException('User ID required');
        }

        $user = $this->repository->getUserById($userId);

        return $user;
    }
}