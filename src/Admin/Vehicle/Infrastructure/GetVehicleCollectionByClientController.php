<?php


namespace Src\Admin\Vehicle\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\Vehicle\Application\GetVehicleCollectionByClientUseCase;
use Src\Admin\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;

final class GetVehicleCollectionByClientController
{
    private $repository;

    public function __construct(EloquentVehicleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): array
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetVehicleCollectionByClientUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
