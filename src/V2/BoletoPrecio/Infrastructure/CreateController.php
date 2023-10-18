<?php

namespace Src\V2\BoletoPrecio\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoPrecio\Application\CreateUseCase;
use Src\V2\BoletoPrecio\Infrastructure\Repositories\EloquentBoletoPrecioRepository;

final class CreateController
{
    private EloquentBoletoPrecioRepository $repository;

    public function __construct( EloquentBoletoPrecioRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $idCliente          = $id;
        $idTipoRuta             = $request->input('idTipoRuta');
        $idRuta             = $request->input('idRuta');
        $idParaderoOrigen             = $request->input('idParaderoOrigen');
        $idParaderoDestino             = $request->input('idParaderoDestino');
        $precioBase         = $request->input('precioBase');
        $idEstado           = $request->input('idEstado');
        $user = Auth::user();

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $idCliente,
            $idTipoRuta,
            $idRuta,
            $idParaderoOrigen,
            $idParaderoDestino,
            $precioBase,
            $idEstado,
            $user->getId()
        );
    }
}
