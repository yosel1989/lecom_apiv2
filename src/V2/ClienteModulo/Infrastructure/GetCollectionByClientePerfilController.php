<?php


namespace Src\V2\ClienteModulo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ClienteModulo\Application\GetCollectionByClientePerfilUseCase;
use Src\V2\ClienteModulo\Infrastructure\Repositories\EloquentClienteModuloRepository;

final class GetCollectionByClientePerfilController
{
    private EloquentClienteModuloRepository $repository;

    public function __construct(EloquentClienteModuloRepository $repository)
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
