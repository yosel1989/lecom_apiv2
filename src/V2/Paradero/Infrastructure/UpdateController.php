<?php

namespace Src\V2\Paradero\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Paradero\Application\UpdateUseCase;
use Src\V2\Paradero\Infrastructure\Repositories\EloquentParaderoRepository;

final class UpdateController
{
    private EloquentParaderoRepository $repository;

    public function __construct( EloquentParaderoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idParadero     = $request->id;
        $nombre             = $request->input('nombre');
        $precioBase         = $request->input('precioBase');
        $latitud         = $request->input('latitud');
        $longitud         = $request->input('longitud');
        $idRuta          = $request->input('idRuta');
        $idEstado           = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idParadero,
            $nombre,
            $precioBase,
            $latitud,
            $longitud,
            $idRuta,
            $idEstado,
            $user->getId()
        );
    }
}
