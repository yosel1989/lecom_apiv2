<?php


namespace Src\Admin\User\Application;


use Src\Admin\User\Domain\Contracts\UserRepositoryContract;
use Src\Admin\User\Domain\ValueObjects\UserActived;
use Src\Admin\User\Domain\ValueObjects\UserId;


final class UpdateActivedUseCase
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
        int $actived
    ): void
    {
        $Uid = new UserId($id);
        $Uactived = new UserActived($actived);

        $this->repository->updateActived(
            $Uid,
            $Uactived
        );

    }
}
