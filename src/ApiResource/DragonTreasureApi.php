<?php


namespace App\ApiResource;

use App\Entity\DragonTreasure;
use ApiPlatform\Metadata\ApiResource;
use App\State\EntityToDtoStateProvider;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiProperty;
use App\State\EntityClassDtoStateProcessor;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

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

    #[NotBlank()]
    public ?string $name = null;

    #[NotBlank()]
    public ?string $description = null;

    #[GreaterThanOrEqual(0)]
    public int $value = 0;
    
    #[GreaterThanOrEqual(0)]
    #[LessThanOrEqual(10)]
    public int $coolFactor = 0;

    public ?UserApi $owner = null;

    public ?string $shortDescription = null;

    public ?string $plunderedAtAgo = null;

    public ?bool $isMine = null;

}