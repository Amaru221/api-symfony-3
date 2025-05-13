<?php

namespace App\State;

use App\ApiResource\UserApi;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\State\Pagination\TraversablePaginator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class EntityToDtoStateProvider implements ProviderInterface
{

    public function __construct(#[Autowire(service: CollectionProvider::class)] private ProviderInterface $collectionProvider)
    {

    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // Retrieve the state from somewhere
        $entities = $this->collectionProvider->provide($operation, $uriVariables, $context);
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

    private function mapEntityToDto(object $entity): object
    {
        $dto = new UserApi();
        $dto->id = $entity->getId();
        $dto->email = $entity->getEmail();
        $dto->username = $entity->getUsername();
        $dto->dragonTreasures = $entity->getDragonTreasures()->toArray();
        $dto->flameThrowingDistance = rand(1,10);

        return $dto;
    }


}
