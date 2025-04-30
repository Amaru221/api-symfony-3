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

        if ($data instanceof DragonTreasure && $data->getOwner() === null && $this->security->getUser()) {
            $data->setOwner($this->security->getUser());
        }

        $this->innerProcessor->process($data, $operation, $uriVariables, $context);

        if($data instanceOf DragonTreasure){
            $data->setIsOwnedByAuthenticatedUser($data->getOwner() === $this->security->getUser());
        }

        return $data;
    }
}
