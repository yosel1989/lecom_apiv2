<?php


namespace Src\V2\Perfil\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Perfil\Application\GetListByClienteUseCase;
use Src\V2\Perfil\Infrastructure\Repositories\EloquentPerfilRepository;

final class GetListByClienteController
{
    private EloquentPerfilRepository $repository;

    public function __construct(EloquentPerfilRepository $repository)
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
        $getVehicleCollectionByClientUseCase = new GetListByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
