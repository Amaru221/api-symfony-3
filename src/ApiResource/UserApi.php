<?php

namespace App\ApiResource;

use App\Entity\User;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;

#[ApiResource(
    shortName: 'User',
    provider: CollectionProvider::class,
    stateOptions: new Options(entityClass: User::class),
)]
class UserApi
{

    public ?int $id = null;

    public ?string $email = null;
    

}