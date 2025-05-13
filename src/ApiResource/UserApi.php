<?php

namespace App\ApiResource;

use App\Entity\User;
use App\Entity\DragonTreasure;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\State\EntityToDtoStateProvider;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ApiResource(
    shortName: 'User',
    provider: EntityToDtoStateProvider::class,
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

    public ?int $flameThrowingDistance = 0;

    /**
     * @var array<int, DragonTreasure>
     */
    public array $dragonTreasures = [];

}