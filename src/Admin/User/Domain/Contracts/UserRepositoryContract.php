<?php


namespace Src\Admin\User\Domain\Contracts;


use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\User\Domain\ValueObjects\UserActived;
use Src\Admin\User\Domain\ValueObjects\UserEmail;
use Src\Admin\User\Domain\ValueObjects\UserFirstName;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Domain\ValueObjects\UserIdClient;
use Src\Admin\User\Domain\ValueObjects\UserIdRole;
use Src\Admin\User\Domain\ValueObjects\UserLastName;
use Src\Admin\User\Domain\ValueObjects\UserLevel;
use Src\Admin\User\Domain\ValueObjects\UserPassword;
use Src\Admin\User\Domain\ValueObjects\UserPhone;
use Src\Admin\User\Domain\ValueObjects\UserUserName;

interface UserRepositoryContract
{

    public function create(
        UserId $id,
        UserUserName $username,
        UserFirstName $firstName,
        UserLastName $lastName,
        UserPassword $password,
        UserEmail $email,
        UserPhone $phone,
        UserLevel $level,
        UserActived $actived,
        UserIdClient $idClient,
        UserIdRole $idRole
    ): ?User;

    public function update(
        UserId $id,
        UserFirstName $firstName,
        UserLastName $lastName,
        UserEmail $email,
        UserPhone $phone,
        UserActived $actived,
        UserIdRole $idRole
    ): ?User;

    public function find(UserId $id): ?User;

    public function trash(UserId $id): void;

    public function restore(UserId $id): void;

    public function delete(UserId $id): void;

    public function updatePassword( UserId $id, UserPassword $password ): void;

    public function assignModules( UserId $id, array $modules ): User;
    public function assignVehicles( UserId $id, array $vehicles, array $ids ): void;

    public function updateActived( UserId $id, UserActived $actived ): void;

    public function collectionByClient( ClientId $UserId ): array;
    public function vehicleCollectionByUser( UserId $UserId ): array;

    public function collectionTrashByClient( ClientId $UserId ): array;

}
