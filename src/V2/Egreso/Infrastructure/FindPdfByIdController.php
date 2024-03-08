<?php


namespace Src\V2\Egreso\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Egreso\Application\FindPdfByIdUseCase;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;
use Src\V2\EgresoDetalle\Application\GetCollectionByClienteUseCase;
use Src\V2\EgresoDetalle\Infrastructure\Repositories\EloquentEgresoDetalleRepository;

final class FindPdfByIdController
{
    private EloquentEgresoRepository $repository;
    private EloquentEgresoDetalleRepository $repositoryDetalle;

    public function __construct(
        EloquentEgresoRepository $repository,
        EloquentEgresoDetalleRepository $repositoryDetalle,
    )
    {
        $this->repository = $repository;
        $this->repositoryDetalle = $repositoryDetalle;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Egreso
    {
        $idEgreso = $request->id;
        $idCliente = $request->idCliente;
        $useCase = new FindPdfByIdUseCase($this->repository);
        $egreso = $useCase->__invoke($idEgreso);

        $useDetalleCase = new GetCollectionByClienteUseCase($this->repositoryDetalle);
        $egresoDetalle = $useDetalleCase->__invoke($idCliente, $idEgreso);

        $egreso->setDetalle($egresoDetalle);

        return $egreso;

    }

}
