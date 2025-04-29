<?php

namespace App\State;

use App\Entity\DragonTreasure;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class DragonTreasureStateProvider implements ProviderInterface
{

    public function __construct(private Security $security, #[Autowire(service: ItemProvider::class)] private ProviderInterface $itemProvider)
    {
        
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $treasure = $this->itemProvider->provide($operation, $uriVariables, $context);

        if(!$treasure instanceof DragonTreasure){
            return $treasure;
        }

        $treasure->setIsOwnedByAuthenticatedUser($this->security->getUser() === $treasure->getOwner());
        // Retrieve the state from somewhere
        return $treasure;
    }
}
