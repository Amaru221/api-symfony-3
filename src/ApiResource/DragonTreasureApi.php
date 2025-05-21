<?php


namespace App\ApiResource;

use App\Entity\DragonTreasure;
use ApiPlatform\Metadata\ApiResource;
use App\State\EntityToDtoStateProvider;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiProperty;
use App\State\EntityClassDtoStateProcessor;

#[ApiResource(
    shortName: 'Treasure',
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: DragonTreasure::class),
    paginationItemsPerPage: 10,
)]
class DragonTreasureApi
{

    #[ApiProperty(readable: false, writable:false, identifier: true)]
    public ?int $id = null;

    public ?string $name = null;

    public int $value = 0;
    
    public int $coolFactor = 0;

    public ?UserApi $owner = null;

    public ?string $shortDescription = null;

    public ?string $plunderedAtAgo = null;

    public ?bool $isMine = null;

}