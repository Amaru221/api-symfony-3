<?php

namespace App\Mapper;

use App\Entity\User;
use App\ApiResource\UserApi;
use App\Entity\DragonTreasure;
use App\ApiResource\DragonTreasureApi;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;

#[AsMapper(from: User::class, to: UserApi::class)]
class UserEntityToApiMapper implements MapperInterface{

    public function __construct(
        private MicroMapperInterface $microMapper,
    )
    {
        
    }

    public function load(object $from, string $toClass, array $context):object {
        $entity = $from;
        assert($entity instanceof User);

        $dto = new UserApi();
        $dto->id = $entity->getId();

        return $dto;

    }

    public function populate(object $from, object $to, array $context): object {
        $entity = $from;
        assert($entity instanceof User);
        $dto = $to;
        assert($dto instanceof UserApi);

        $dto->email = $entity->getEmail();
        $dto->username = $entity->getUsername();
        //$dto->dragonTreasures = $entity->getPublishedDragonTreasures()->getValues();
        $dto->dragonTreasures = array_map(function(DragonTreasure $dragonTreasure){
            return $this->microMapper->map($dragonTreasure, DragonTreasureApi::class, [
                MicroMapperInterface::MAX_DEPTH => 0,
            ]);
        }, $entity->getPublishedDragonTreasures()->getValues());
        $dto->flameThrowingDistance = rand(1, 10);

        return $dto;
    }
}