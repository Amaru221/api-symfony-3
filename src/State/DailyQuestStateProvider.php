<?php

namespace App\State;

use App\ApiResource\DailyQuest;
use App\Enum\DailyQuestStatusEnum;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use ApiPlatform\Metadata\CollectionOperationInterface;

class DailyQuestStateProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // Retrieve the state from somewhere
        if($operation instanceof CollectionOperationInterface){
                return $this->createQuests();
        }
        $quest = $this->createQuests();
        return $quests[$uriVariables['dayString']] ?? null;
    }

    public function createQuests(): array
    {
        $quests = [];
        for ($i = 0; $i<50; $i++){
            $quest = new DailyQuest(new \DateTimeImmutable(sprintf('- %d days', $i)));
            $quest->questName = sprintf('Description %d', $i);
            $quest->description = sprintf('Description %d', $i);
            $quest->difficultyLevel = $i % 10;
            $quest->status = $i % 2 === 0 ? DailyQuestStatusEnum::ACTIVE : DailyQuestStatusEnum::COMPLETED;
            $quests[$quest->getDayString()] = $quest;
        }

        return $quests;
    }
}
