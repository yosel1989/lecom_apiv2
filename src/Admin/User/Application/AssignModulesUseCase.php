<?php


namespace Src\Admin\User\Application;


use Src\Admin\User\Domain\Contracts\UserRepositoryContract;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Domain\ValueObjects\UserId;


final class AssignModulesUseCase
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
        array $modules
    ): User
    {
        $Uid = new UserId($id);

        return $this->repository->assignModules(
            $Uid,
            $modules
        );

    }
}
