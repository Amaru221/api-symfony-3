<?php

namespace App\State;

use App\Entity\User;
use App\ApiResource\UserApi;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class EntityClassDtoStateProcessor implements ProcessorInterface
{

    public function __construct(private UserRepository $userRepository){

    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        // Handle the state
        assert($data instanceof UserApi);
        $entity = $this->mapDtoToEntity($data);
        dd($entity);
    }

    private function mapDtoToEntity(object $userApi){
        assert($userApi instanceof UserApi);

        if($userApi->id)
        {
            $entity = $this->userRepository->find($userApi->id);
            if(!$entity){
                $entity = new User();
                
            }
        }

    }
}
