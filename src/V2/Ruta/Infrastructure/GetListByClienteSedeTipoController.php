<?php


namespace Src\V2\Ruta\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Ruta\Application\GetListByClienteSedeTipoUseCase;
use Src\V2\Ruta\Infrastructure\Repositories\EloquentRutaRepository;

final class GetListByClienteSedeTipoController
{
    private EloquentRutaRepository $repository;

    public function __construct(EloquentRutaRepository $repository)
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
        $idSede = $request->idSede;
        $idTipo = $request->idTipo;
        $getVehicleCollectionByClientUseCase = new GetListByClienteSedeTipoUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient, $idSede, $idTipo);
    }

}
