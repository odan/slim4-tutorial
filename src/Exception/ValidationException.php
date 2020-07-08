<?php

namespace App\Exception;

use RuntimeException;
use Throwable;

/**
 * Validation Exception
 */
final class ValidationException extends RuntimeException
{
    /**
     * @var array
     */
    private $errors;

    /**
     * The constructor.
     *
     * @param array $errors The errors
     * @param string $message The error message
     * @param int $code The error code
     * @param Throwable|null $previous The previous exception
     */
    public function __construct(string $message, array $errors = [], int $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->errors = $errors;
    }

    /**
     * Get error details.
     *
     * @return array The details
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}