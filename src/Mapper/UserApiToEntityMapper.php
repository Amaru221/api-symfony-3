<?php
namespace App\Mapper;

use App\Entity\User;
use App\ApiResource\UserApi;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;

#[AsMapper(from: UserApi::class, to: User::class)]
class UserApiToEntityMapper implements MapperInterface
{

    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher,
    )
    {
        
    }
    public function load(object $from, string $toClass, array $context): object
    {
        $dto = $from;
        assert($dto instanceof UserApi);

        $userEntity = $dto->id ? $this->userRepository->find($dto->id) : new User();

        if(!$userEntity)
        {
            throw new Exception('User not found'); 
        }

        return $userEntity;
    }

    public function populate(object $from, object $to, array $context): object{
        //TODO implement populate() method

        $dto = $from;
        assert($dto instanceof UserApi);

        $entity = $to;
        assert($entity instanceof User);

        $entity->setEmail($dto->email);
        $entity->setUsername($dto->username);

        if($dto->password){
            $entity->setPassword($this->userPasswordHasher->hashPassword($entity, $dto->password));
        }

        return $entity;
    }
}