<?php

namespace Src\V2\Vehiculo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Vehiculo\Application\CreateUseCase;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class CreateController
{
    private EloquentVehiculoRepository $repository;

    public function __construct( EloquentVehiculoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $placa          = $request->input('placa');
        $unidad         = $request->input('unidad');
        $idCliente   = $request->idCliente;
        $idEstado   = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $placa,
            $unidad,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
