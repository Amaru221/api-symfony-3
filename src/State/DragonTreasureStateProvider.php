<?php

namespace App\State;

use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use App\Entity\DragonTreasure;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\CollectionOperationInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class DragonTreasureStateProvider implements ProviderInterface
{

    public function __construct(private Security $security, #[Autowire(service: ItemProvider::class)] private ProviderInterface $itemProvider, #[Autowire(service: CollectionProvider::class)] private ProviderInterface $collectionProvider)
    {
        
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {

        if($operation instanceof CollectionOperationInterface){

            $paginator = $this->collectionProvider->provide($operation, $uriVariables, $context);

            foreach($paginator as $treasure){
                $treasure->setIsOwnedByAuthenticatedUser($this->security->getUser() === $treasure->getOwner());
            }

            return $paginator;

        }

        $treasure = $this->itemProvider->provide($operation, $uriVariables, $context);

        if(!$treasure instanceof DragonTreasure){
            return $treasure;
        }

        $treasure->setIsOwnedByAuthenticatedUser($this->security->getUser() === $treasure->getOwner());
        // Retrieve the state from somewhere
        return $treasure;
    }
}
