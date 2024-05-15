<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\CronogramaSalida\Application\FindPdfByIdUseCase;
use Src\V2\CronogramaSalida\Domain\CronogramaSalida;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;
use Src\V2\CronogramaSalidaDetalle\Application\GetCollectionByClienteUseCase;
use Src\V2\CronogramaSalidaDetalle\Infrastructure\Repositories\EloquentCronogramaSalidaDetalleRepository;

final class FindPdfByIdController
{
    private EloquentCronogramaSalidaRepository $repository;
    private EloquentCronogramaSalidaDetalleRepository $repositoryDetalle;

    public function __construct(
        EloquentCronogramaSalidaRepository $repository,
        EloquentCronogramaSalidaDetalleRepository $repositoryDetalle,
    )
    {
        $this->repository = $repository;
        $this->repositoryDetalle = $repositoryDetalle;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): CronogramaSalida
    {
        $idCronogramaSalida = $request->id;
        $idCliente = $request->idCliente;
        $useCase = new FindPdfByIdUseCase($this->repository);
        $CronogramaSalida = $useCase->__invoke($idCronogramaSalida);

        $useDetalleCase = new GetCollectionByClienteUseCase($this->repositoryDetalle);
        $CronogramaSalidaDetalle = $useDetalleCase->__invoke($idCliente, $idCronogramaSalida);

        $CronogramaSalida->setDetalle($CronogramaSalidaDetalle);

        return $CronogramaSalida;

    }

}
