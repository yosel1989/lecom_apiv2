<?php


namespace Src\V2\Cronograma\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Cronograma\Application\FindPdfByIdUseCase;
use Src\V2\Cronograma\Domain\Cronograma;
use Src\V2\Cronograma\Infrastructure\Repositories\EloquentCronogramaRepository;
use Src\V2\CronogramaDetalle\Application\GetCollectionByClienteUseCase;
use Src\V2\CronogramaDetalle\Infrastructure\Repositories\EloquentCronogramaDetalleRepository;

final class FindPdfByIdController
{
    private EloquentCronogramaRepository $repository;
    private EloquentCronogramaDetalleRepository $repositoryDetalle;

    public function __construct(
        EloquentCronogramaRepository $repository,
        EloquentCronogramaDetalleRepository $repositoryDetalle,
    )
    {
        $this->repository = $repository;
        $this->repositoryDetalle = $repositoryDetalle;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Cronograma
    {
        $idCronograma = $request->id;
        $idCliente = $request->idCliente;
        $useCase = new FindPdfByIdUseCase($this->repository);
        $Cronograma = $useCase->__invoke($idCronograma);

        $useDetalleCase = new GetCollectionByClienteUseCase($this->repositoryDetalle);
        $CronogramaDetalle = $useDetalleCase->__invoke($idCliente, $idCronograma);

        $Cronograma->setDetalle($CronogramaDetalle);

        return $Cronograma;

    }

}
