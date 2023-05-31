<?php


namespace Src\Admin\User\Application;


use Src\Admin\User\Domain\Contracts\UserRepositoryContract;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Domain\ValueObjects\UserId;


final class AssignVehiclesUseCase
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
        array $vehicles,
        array $ids
    ): void
    {
        $Uid = new UserId($id);

         $this->repository->assignVehicles(
            $Uid,
            $vehicles,
            $ids
        );

    }
}
