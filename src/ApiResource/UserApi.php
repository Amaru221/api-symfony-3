<?php

namespace App\ApiResource;

use App\Entity\User;
use App\Entity\DragonTreasure;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\State\EntityToDtoStateProvider;
use ApiPlatform\Doctrine\Orm\State\Options;
use App\State\EntityClassDtoStateProcessor;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[ApiResource(
    shortName: 'User',
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: User::class),
    paginationItemsPerPage: 5,
    normalizationContext: [AbstractNormalizer::IGNORED_ATTRIBUTES => ['flameThrowingDistance']],
    denormalizationContext: [AbstractNormalizer::IGNORED_ATTRIBUTES => ['flameThrowingDistance']],
)]
#[ApiFilter(SearchFilter::class, properties: [
    'username'=> 'partial',
])]
class UserApi
{

    #[ApiProperty(readable: false, identifier: true)]
    public ?int $id = null;

    public ?string $email = null;

    public ?string $username = null;

    /**
     * The plaintext password when baing set or changed.
     */
    #[ApiProperty(readable: false)]
    public ?string $password = null;

    #[Ignore]
    public ?int $flameThrowingDistance = 0;

    /**
     * @var array<int, DragonTreasure>
     */
    public array $dragonTreasures = [];

}