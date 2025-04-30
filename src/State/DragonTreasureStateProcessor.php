<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\DragonTreasure;
use Symfony\Bundle\SecurityBundle\Security;

class DragonTreasureStateProcessor implements ProcessorInterface
{
    public function __construct(private ProcessorInterface $innerProcessor, private Security $security)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {

        assert($data instanceof DragonTreasure);

        $data->setOwner($this->security->getUser());

        $this->innerProcessor->process($data, $operation, $uriVariables, $context);

        $data->setIsOwnedByAuthenticatedUser($data->getOwner() === $this->security->getUser());

        $previousData = $context['previous_data'] ?? null;

        if($previousData instanceof DragonTreasure && $data->getIsPublished() && $previousData->getIsPublished() !== $data->getIsPublished()){
            dd('isPublished!');
        }

        return $data;
    }
}
