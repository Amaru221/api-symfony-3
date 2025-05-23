<?php

namespace App\State;

use App\Entity\User;
use App\ApiResource\UserApi;
use ApiPlatform\Metadata\Operation;
use App\ApiResource\DragonTreasureApi;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\DeleteOperationInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;
use ApiPlatform\Doctrine\Common\State\RemoveProcessor;
use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class EntityClassDtoStateProcessor implements ProcessorInterface
{

    public function __construct(
        #[Autowire(service: PersistProcessor::class)] private PersistProcessor $persistProcessor,
        #[Autowire(service: RemoveProcessor::class)] private RemoveProcessor $removeProcessor,
        private MicroMapperInterface $microMapper,
    ){

    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $stateOptions = $operation->getStateOptions();
        assert($stateOptions instanceof Options);
        $entityClass = $stateOptions->getEntityClass();
        $entity = $this->mapDtoToEntity($data, $entityClass);

        if($operation instanceof DeleteOperationInterface){
            $this->removeProcessor->process($data, $operation, $uriVariables, $context);
            return null;
        }

        $this->persistProcessor->process($entity, $operation, $uriVariables, $context);

        $data->id = $entity->getId();

        return $data;
    }

    private function mapDtoToEntity(object $userApi, string $entityClass){
        // TODO: handle drangon Treasures 

        return $this->microMapper->map($userApi, $entityClass);
    }
}
