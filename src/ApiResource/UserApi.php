<?php

namespace App\ApiResource;

use App\Entity\User;
use App\Entity\DragonTreasure;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\State\EntityToDtoStateProvider;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use App\State\EntityClassDtoStateProcessor;

#[ApiResource(
    shortName: 'User',
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: User::class),
    paginationItemsPerPage: 5,
)]
#[ApiFilter(SearchFilter::class, properties: [
    'username'=> 'partial',
])]
class UserApi
{

    public ?int $id = null;

    public ?string $email = null;

    public ?string $username = null;

    /**
     * The plaintext password when baing set or changed.
     */
    public ?string $password = null;

    public ?int $flameThrowingDistance = 0;

    /**
     * @var array<int, DragonTreasure>
     */
    public array $dragonTreasures = [];

}