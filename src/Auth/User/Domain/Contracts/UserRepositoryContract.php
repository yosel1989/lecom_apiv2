<?php


namespace Src\Auth\User\Domain\Contracts;


use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Auth\User\Domain\User;
use Src\Auth\User\Domain\ValueObjects\UserId;
use Src\Auth\User\Domain\ValueObjects\UserPassword;

interface UserRepositoryContract
{

    public function create(User $user): ?User;

    public function update(UserId $userId, User $user): ?User;

    public function find(UserId $id): ?User;

    public function trash(UserId $id): void;

    public function restore(UserId $id): void;

    public function delete(UserId $id): void;

    public function changePassword( UserId $id, UserPassword $password ): void;

    public function collectionByClient( ClientId $clientId ): array;

    public function collectionTrashByClient( ClientId  $clientId ): array;

}
