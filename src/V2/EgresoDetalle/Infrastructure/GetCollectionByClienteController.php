<?php


namespace Src\V2\EgresoDetalle\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EgresoDetalle\Application\GetCollectionByClienteUseCase;
use Src\V2\EgresoDetalle\Domain\EgresoDetalleList;
use Src\V2\EgresoDetalle\Infrastructure\Repositories\EloquentEgresoDetalleRepository;

final class GetCollectionByClienteController
{
    private EloquentEgresoDetalleRepository $repository;

    public function __construct(EloquentEgresoDetalleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): EgresoDetalleList
    {
        $idClient = $request->id;
        $idEgreso = $request->idEgreso;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient, $idEgreso);
    }

}
