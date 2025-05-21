<?php

namespace App\Mapper;

use App\Entity\DragonTreasure;
use App\ApiResource\DragonTreasureApi;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: DragonTreasure::class, to: DragonTreasureApi::class)]
class DragonTreasureEntityToApiMapper implements MapperInterface
{
    public function load(object $from, string $toClass, array $context): object
    {
        dd();
    }


    public function populate(object $from, object $to, array $context): object
    {
        dd();
    }
}