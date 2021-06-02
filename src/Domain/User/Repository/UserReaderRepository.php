<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserReaderResult;
use DomainException;
use PDO;

/**
 * Repository.
 */
class UserReaderRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get user by the given user id.
     *
     * @param int $userId The user id
     *
     * @throws DomainException
     *
     * @return array The user row
     */
    public function getUserById(int $userId): array
    {
        $sql = "SELECT id, username, first_name, last_name, email FROM users WHERE id = :id;";
        $statement = $this->connection->prepare($sql);
        $statement->execute(['id' => $userId]);

        $row = $statement->fetch();

        if (!$row) {
            throw new DomainException(sprintf('User not found: %s', $userId));
        }

        return $row;
    }
}
