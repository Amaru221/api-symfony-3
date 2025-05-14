<?php

namespace App\State;

use App\ApiResource\UserApi;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class EntityClassDtoStateProcessor implements ProcessorInterface
{
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        // Handle the state
        assert($data instanceof UserApi);
        $entity = $this->mapDtoToEntity($data);
        dd($entity);
    }

    private function mapDtoToEntity(object $userApi){
        assert($userApi instanceof UserApi);

    }
}
