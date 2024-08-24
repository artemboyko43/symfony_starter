<?php

declare(strict_types=1);

namespace App\Users\Application\Command\CreateUser;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\Command\CommandInterface;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Repository\UserRepository;

class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @return string ID user
     */
    public function __invoke(CreateUserCommand $createUserCommand): string
    {
        $user = (new UserFactory())->create($createUserCommand->email, $createUserCommand->password);
        $this->userRepository->add($user);

        return $user->getUlid();
        // TODO: Implement __invoke() method.
    }
}