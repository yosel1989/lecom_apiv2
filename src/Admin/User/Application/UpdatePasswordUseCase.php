<?php


namespace Src\Admin\User\Application;


use Src\Admin\User\Domain\Contracts\UserRepositoryContract;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Admin\User\Domain\ValueObjects\UserPassword;

final class UpdatePasswordUseCase
{
    /**
     * @var UserRepositoryContract
     */
    private $repository;

    public function __construct( UserRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $password
    ): void
    {
        $Uid = new UserId($id);
        $Upassword = new UserPassword($password);

        $this->repository->updatePassword(
            $Uid,
            $Upassword
        );

    }
}
