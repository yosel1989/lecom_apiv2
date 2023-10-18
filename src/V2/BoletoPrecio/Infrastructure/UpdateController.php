<?php

namespace Src\V2\BoletoPrecio\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoPrecio\Application\UpdateUseCase;
use Src\V2\BoletoPrecio\Infrastructure\Repositories\EloquentBoletoPrecioRepository;

final class UpdateController
{
    private EloquentBoletoPrecioRepository $repository;

    public function __construct( EloquentBoletoPrecioRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $idBoletoPrecio     = $request->id;
        $idParaderoOrigen             = $request->input('idParaderoOrigen');
        $idParaderoDestino             = $request->input('idParaderoDestino');
        $precioBase         = $request->input('precioBase');
        $idEstado           = $request->input('idEstado');
        $user = Auth::user();

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idBoletoPrecio,
            $idParaderoOrigen,
            $idParaderoDestino,
            $precioBase,
            $idEstado,
            $user->getId()
        );
    }
}
