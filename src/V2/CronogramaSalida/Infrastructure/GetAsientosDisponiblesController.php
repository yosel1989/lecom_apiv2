<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\CronogramaSalida\Application\GetAsientosDisponiblesUseCase;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class GetAsientosDisponiblesController
{
    private EloquentCronogramaSalidaRepository $repository;

    public function __construct(EloquentCronogramaSalidaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): NumericInteger
    {
        $idCliente = $request->idCliente;
        $idCronogramaAsiento = $request->id;
        $useCase = new GetAsientosDisponiblesUseCase($this->repository);
        return $useCase->__invoke($idCliente, $idCronogramaAsiento);
    }

}
