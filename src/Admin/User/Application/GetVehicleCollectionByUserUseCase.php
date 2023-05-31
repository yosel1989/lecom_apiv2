<?php


namespace Src\Admin\User\Application;

use Src\Admin\User\Domain\Contracts\UserRepositoryContract;
use Src\Admin\User\Domain\ValueObjects\UserId;

final class GetVehicleCollectionByUserUseCase
{
    private $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idUser ): array
    {
        return $this->repository->vehicleCollectionByUser(
            new UserId( $idUser )
        );
    }

}
