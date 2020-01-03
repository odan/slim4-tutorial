<?php

namespace App\Domain\User\Data;

final class UserCreateData
{
    /** @var string */
    public $username;

    /** @var string */
    public $firstName;

    /** @var string */
    public $lastName;

    /** @var string */
    public $email;
}