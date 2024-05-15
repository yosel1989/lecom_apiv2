<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CronogramaSalida\Application\GetReporteByClienteUseCase;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaList;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class GetReporteByClienteController
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
    public function __invoke( Request $request ): CronogramaSalidaList
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
