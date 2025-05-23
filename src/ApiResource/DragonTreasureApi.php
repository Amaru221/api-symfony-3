<?php


namespace App\ApiResource;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Entity\DragonTreasure;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\State\EntityToDtoStateProvider;
use ApiPlatform\Doctrine\Orm\State\Options;
use App\State\EntityClassDtoStateProcessor;
use App\Validator\IsValidOwner;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

#[ApiResource(
    shortName: 'Treasure',
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: DragonTreasure::class),
    paginationItemsPerPage: 10,
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            security: 'is_granted("ROLE_TREASURE_CREATE")',
        ),
        new Patch(
            security: 'is_granted("EDIT", object)',
        ),
        new Delete(
            security: 'is_granted("ROLE_ADMIN")',
        ),
    ]
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

    #[IsValidOwner()]
    public ?UserApi $owner = null;

    public ?string $shortDescription = null;

    public ?string $plunderedAtAgo = null;

    public ?bool $isMine = null;

}