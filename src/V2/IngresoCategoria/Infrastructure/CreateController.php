<?php

namespace Src\V2\IngresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\IngresoCategoria\Application\CreateUseCase;
use Src\V2\IngresoCategoria\Infrastructure\Repositories\EloquentIngresoCategoriaRepository;

final class CreateController
{
    private EloquentIngresoCategoriaRepository $repository;

    public function __construct( EloquentIngresoCategoriaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $idCliente          = $request->input('idCliente');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
