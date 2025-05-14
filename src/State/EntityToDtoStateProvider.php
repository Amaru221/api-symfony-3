<?php

namespace App\State;

use App\ApiResource\UserApi;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Doctrine\Orm\Paginator;
use ApiPlatform\State\ProviderInterface;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\State\Pagination\TraversablePaginator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class EntityToDtoStateProvider implements ProviderInterface
{

    public function __construct(
        #[Autowire(service: CollectionProvider::class)] private ProviderInterface $collectionProvider, 
        #[Autowire(service: ItemProvider::class)] private ProviderInterface $itemProvider
    )
    {

    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if($operation instanceof CollectionOperationInterface){
            $entities = $this->collectionProvider->provide($operation, $uriVariables, $context);
            assert($entities instanceof Paginator);

            $dtos = [];
            foreach($entities as $entity){
                $dtos [] = $this->mapEntityToDto($entity);
            }

            return new TraversablePaginator(
                new \ArrayIterator($dtos),
                $entities->getCurrentPage(),
                $entities->getItemsPerPage(),
                $entities->getTotalItems(),
            );
        }

        $entity = $this->itemProvider->provide($operation, $uriVariables, $context);
        
        if(!$entity){
            return null;
        }

        return $this->mapEntityToDto($entity);

    }

    private function mapEntityToDto(object $entity): object
    {
        $dto = new UserApi();
        $dto->id = $entity->getId();
        $dto->email = $entity->getEmail();
        $dto->username = $entity->getUsername();
        $dto->dragonTreasures = $entity->getPublishedDragonTreasures()->getValues();
        $dto->flameThrowingDistance = rand(1,10);

        return $dto;
    }


}
