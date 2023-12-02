<?php


namespace Src\V2\Vehiculo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Vehiculo\Application\GetCollectionByUsuarioUseCase;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class GetCollectionByUsuarioController
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
        $idUsuario = $request->id;
        $useCase = new GetCollectionByUsuarioUseCase($this->repository);
        return $useCase->__invoke($idUsuario);
    }

}
