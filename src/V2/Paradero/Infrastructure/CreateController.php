<?php

namespace Src\V2\Paradero\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Paradero\Application\CreateUseCase;
use Src\V2\Paradero\Infrastructure\Repositories\EloquentParaderoRepository;

final class CreateController
{
    private EloquentParaderoRepository $repository;

    public function __construct( EloquentParaderoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
//        $precioBase         = $request->input('precioBase');
        $latitud         = $request->input('latitud');
        $longitud         = $request->input('longitud');
        $idCliente          = $id;
        $idTipoRuta          = $request->input('idTipoRuta');
//        $idRuta          = $request->input('idRuta');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
//            $precioBase,
            $latitud,
            $longitud,
            $idTipoRuta,
//            $idRuta,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
