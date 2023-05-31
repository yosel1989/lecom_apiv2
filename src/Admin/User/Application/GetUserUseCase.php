<?php


namespace Src\Admin\User\Application;


use Src\Admin\User\Domain\Contracts\UserRepositoryContract;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Domain\ValueObjects\UserId;

final class GetUserUseCase
{
    private $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $UserId): ?User
    {
        $id = new UserId($UserId);
        return $this->repository->find($id);
    }
}
