<?php

declare(strict_types=1);

namespace App\Users\Application\Command\CreateUser;

use App\Shared\Application\Command\CommandInterface;

class CreateUserCommand implements CommandInterface
{
    public function __construct(public string $email, public string $password)
    {

    }

    public function execute(CommandInterface $command): mixed
    {
        // TODO: Implement execute() method.
    }
}