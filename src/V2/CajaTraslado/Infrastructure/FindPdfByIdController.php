<?php


namespace Src\V2\CajaTraslado\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\CajaTraslado\Application\FindPdfByIdUseCase;
use Src\V2\CajaTraslado\Domain\CajaTraslado;
use Src\V2\CajaTraslado\Infrastructure\Repositories\EloquentCajaTrasladoRepository;
use Src\V2\CajaTrasladoDetalle\Application\GetCollectionByClienteUseCase;
use Src\V2\CajaTrasladoDetalle\Infrastructure\Repositories\EloquentCajaTrasladoDetalleRepository;

final class FindPdfByIdController
{
    private EloquentCajaTrasladoRepository $repository;
    private EloquentCajaTrasladoDetalleRepository $repositoryDetalle;

    public function __construct(
        EloquentCajaTrasladoRepository $repository,
        EloquentCajaTrasladoDetalleRepository $repositoryDetalle,
    )
    {
        $this->repository = $repository;
        $this->repositoryDetalle = $repositoryDetalle;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): CajaTraslado
    {
        $idCajaTraslado = $request->id;
        $idCliente = $request->idCliente;
        $useCase = new FindPdfByIdUseCase($this->repository);
        $CajaTraslado = $useCase->__invoke($idCajaTraslado);

        $useDetalleCase = new GetCollectionByClienteUseCase($this->repositoryDetalle);
        $CajaTrasladoDetalle = $useDetalleCase->__invoke($idCliente, $idCajaTraslado);

        $CajaTraslado->setDetalle($CajaTrasladoDetalle);

        return $CajaTraslado;

    }

}
