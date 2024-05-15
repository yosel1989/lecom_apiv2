<?php


namespace Src\V2\Cronograma\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Cronograma\Application\GetReporteByClienteUseCase;
use Src\V2\Cronograma\Domain\CronogramaList;
use Src\V2\Cronograma\Infrastructure\Repositories\EloquentCronogramaRepository;

final class GetReporteByClienteController
{
    private EloquentCronogramaRepository $repository;

    public function __construct(EloquentCronogramaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): CronogramaList
    {
        $user = Auth::user();
        $idUsuario = $user->getId();

        $idClient = $request->input('idCliente');
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');
        $idVehiculo = $request->input('idVehiculo');
        $idPersonal = $request->input('idPersonal');
        $useCase = new GetReporteByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient, $fechaDesde, $fechaHasta, $idVehiculo, $idPersonal);
    }

}
