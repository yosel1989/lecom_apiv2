<?php

namespace Src\V2\Vehiculo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Vehiculo\Application\CreateUseCase;
use Src\V2\Vehiculo\Application\UpdateUseCase;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class UpdateController
{
    private EloquentVehiculoRepository $repository;

    public function __construct( EloquentVehiculoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idVehiculo     = $request->id;
        $placa          = $request->input('placa');
        $unidad         = $request->input('unidad');
        $numAsientos         = $request->input('numeroAsientos');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idVehiculo,
            $placa,
            $unidad,
            $numAsientos,
            $idEstado,
            $user->getId()
        );
    }
}
