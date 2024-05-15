<?php

namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CronogramaSalida\Application\UpdateUseCase;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class UpdateController
{
    private EloquentCronogramaSalidaRepository $repository;

    public function __construct( EloquentCronogramaSalidaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idCronogramaSalida     = $request->id;
        $idCliente          = $request->input('idCliente');
        $idCronograma          = $request->input('idCronograma');
        $idVehiculo          = $request->input('idVehiculo');
        $fecha          = $request->input('fecha');
        $hora          = $request->input('hora');
        $idEstado          = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idCronogramaSalida,
            $idCliente,
            $idCronograma,
            $idVehiculo,
            $fecha,
            $hora,
            $idEstado,
            $user->getId()
        );
    }
}
