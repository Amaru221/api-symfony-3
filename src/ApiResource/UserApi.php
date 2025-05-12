<?php

namespace App\ApiResource;

use App\Entity\User;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\State\Options;

#[ApiResource(
    shortName: 'User',
    stateOptions: new Options(entityClass: User::class),
    paginationItemsPerPage: 5,
)]
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