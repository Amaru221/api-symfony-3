<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Odm\Filter\SearchFilter;
use App\Entity\User;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiFilter;

#[ApiResource(
    shortName: 'User',
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
     * @var array<int, DragonTreasure>
     */
    public array $dragonTreasures = [];

}