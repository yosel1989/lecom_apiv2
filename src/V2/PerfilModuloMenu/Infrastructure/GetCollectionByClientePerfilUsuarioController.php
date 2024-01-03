<?php


namespace Src\V2\PerfilModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\PerfilModuloMenu\Application\GetCollectionByClientePerfilUsuarioUseCase;
use Src\V2\PerfilModuloMenu\Infrastructure\Repositories\EloquentPerfilModuloMenuRepository;

final class GetCollectionByClientePerfilUsuarioController
{
    private EloquentPerfilModuloMenuRepository $repository;

    public function __construct(EloquentPerfilModuloMenuRepository $repository)
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
        $idModulo = $request->idModulo;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClientePerfilUsuarioUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient, $idPerfil, $idModulo);
    }

}
