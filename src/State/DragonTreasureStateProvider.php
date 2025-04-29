<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class DragonTreasureStateProvider implements ProviderInterface
{

    public function __construct(private ProviderInterface $itemProvider)
    {
        
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // Retrieve the state from somewhere
        dd($operation);
    }
}
