<?php


namespace Src\V2\Empresa\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Empresa\Application\GetListByClienteUseCase;
use Src\V2\Empresa\Infrastructure\Repositories\EloquentEmpresaRepository;

final class GetListByClienteController
{
    private EloquentEmpresaRepository $repository;

    public function __construct(EloquentEmpresaRepository $repository)
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
