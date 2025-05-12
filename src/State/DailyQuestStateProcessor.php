<?php
namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use DateTimeImmutable;

class DailyQuestStateProcessor implements ProcessorInterface {

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $data->lastUpdate = new DateTimeImmutable('now');
    }

}