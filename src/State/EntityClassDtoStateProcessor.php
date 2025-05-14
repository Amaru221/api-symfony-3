<?php

namespace App\State;

use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use App\Entity\User;
use App\ApiResource\UserApi;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class EntityClassDtoStateProcessor implements ProcessorInterface
{

    public function __construct(
        private UserRepository $userRepository,
        #[Autowire(service: PersistProcessor::class)] private PersistProcessor $persistProcessor,
    ){

    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        // Handle the state
        assert($data instanceof UserApi);
        $entity = $this->mapDtoToEntity($data);
        $this->persistProcessor->process($entity, $operation, $uriVariables, $context);
        return $data;
    }

    private function mapDtoToEntity(object $userApi){
        assert($userApi instanceof UserApi);

        if($userApi->id)
        {
            $entity = $this->userRepository->find($userApi->id);
            if(!$entity){
                throw new \Exception(sprintf('Entity %d not found', $userApi->id));
                
            }
        }else{
            $entity = new User();
        }

        $entity->setEmail($userApi->email);
        $entity->setUsername($userApi->username);
        $entity->setPassword('TODO properly');
        // TODO: handle drangon Treasures 

        return $entity;
    }
}
