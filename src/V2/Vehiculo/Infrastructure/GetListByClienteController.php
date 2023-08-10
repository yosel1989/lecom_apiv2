<?php


namespace Src\V2\Vehiculo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Vehiculo\Application\GetListByClienteUseCase;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class GetListByClienteController
{
    private EloquentVehiculoRepository $repository;

    public function __construct(EloquentVehiculoRepository $repository)
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
        $useCase = new GetListByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient);
    }

}
