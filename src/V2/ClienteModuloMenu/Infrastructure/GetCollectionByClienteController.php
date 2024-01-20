<?php


namespace Src\V2\ClienteModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ClienteModuloMenu\Application\GetCollectionByClientePerfilUseCase;
use Src\V2\ClienteModuloMenu\Infrastructure\Repositories\EloquentClienteModuloMenuRepository;

final class GetCollectionByClienteController
{
    private EloquentClienteModuloMenuRepository $repository;

    public function __construct(EloquentClienteModuloMenuRepository $repository)
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
        $idModulo = $request->idModulo;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClientePerfilUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient, $idModulo);
    }

}
