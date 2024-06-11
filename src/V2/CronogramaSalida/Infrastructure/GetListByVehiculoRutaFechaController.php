<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\CronogramaSalida\Application\GetListByVehiculoRutaFechaUseCase;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaShortList;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class GetListByVehiculoRutaFechaController
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
    public function __invoke( Request $request ): CronogramaSalidaShortList
    {
        $idVehiculo = $request->idVehiculo;
        $idRuta = $request->idRuta;
        $fecha = (new \DateTime('now'))->format('Y-m-d');
        $useCase = new GetListByVehiculoRutaFechaUseCase($this->repository);
        return $useCase->__invoke($idVehiculo, $idRuta, $fecha);
    }

}
