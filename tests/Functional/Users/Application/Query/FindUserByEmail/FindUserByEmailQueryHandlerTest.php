<?php

namespace Functional\Users\Application\Query\FindUserByEmail;

use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\Resource\Fixture\UserFixture;
use App\Users\Application\DTO\UserDTO;
use App\Users\Application\Query\FindUserByEmail\FindUserByEmailQuery;
use App\Users\Infrastructure\Repository\UserRepository;
use Faker\Factory;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FindUserByEmailQueryHandlerTest extends WebTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->queryBus = $this::getContainer()->get(QueryBusInterface::class);
        $this->userRepository = $this::getContainer()->get(UserRepository::class);
        $this->databaseTool = $this::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function test_user_created_when_command_executed(): void
    {g
        // arrange
        $referenceRepository = $this->databaseTool->loadFixtures([UserFixture::class])->getReferenceRepository();

        $user = $referenceRepository->getReference(UserFixture::REFERENCE);
        $query = new FindUserByEmailQuery($user->getEmail());

        // act
        $userDTO = $this->queryBus->execute($query);

        // assert
        $this->assertInstanceOf(UserDTO::class, $userDTO);
    }
}
