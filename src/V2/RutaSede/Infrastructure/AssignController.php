<?php

namespace Src\V2\RutaSede\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\RutaSede\Application\AssignUseCase;
use Src\V2\RutaSede\Infrastructure\Repositories\EloquentRutaSedeRepository;

final class AssignController
{
    private EloquentRutaSedeRepository $repository;

    public function __construct( EloquentRutaSedeRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        $user = Auth::user();
        $idCliente             = $request->input('idCliente');
        $idRuta     = $request->input('idRuta');
        $sedes          = $request->input('sedes');

        $useCase = new AssignUseCase( $this->repository );
        $useCase->__invoke(
            $idCliente,
            $idRuta,
            $sedes,
            $user->getId()
        );
    }

}
