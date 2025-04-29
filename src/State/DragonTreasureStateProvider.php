<?php

namespace App\State;

use ApiPlatform\Doctrine\Odm\State\ItemProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class DragonTreasureStateProvider implements ProviderInterface
{

    public function __construct(#[Autowire(service: ItemProvider::class)]private ProviderInterface $itemProvider)
    {
        
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // Retrieve the state from somewhere
        dd($operation);
    }
}
