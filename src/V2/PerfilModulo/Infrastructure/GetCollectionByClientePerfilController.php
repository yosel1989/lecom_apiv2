<?php


namespace Src\V2\PerfilModulo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\PerfilModulo\Application\GetCollectionByClientePerfilUseCase;
use Src\V2\PerfilModulo\Infrastructure\Repositories\EloquentPerfilModuloRepository;

final class GetCollectionByClientePerfilController
{
    private EloquentPerfilModuloRepository $repository;

    public function __construct(EloquentPerfilModuloRepository $repository)
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
        $idPerfil = $request->idPerfil;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClientePerfilUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient, $idPerfil);
    }

}
