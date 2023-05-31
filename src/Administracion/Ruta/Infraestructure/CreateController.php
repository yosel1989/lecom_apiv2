<?php


namespace Src\Administracion\Ruta\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Administracion\Ruta\Application\CreateUseCase;
use Src\Administracion\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class CreateController
{

    /**
     * @var EloquentRutaRepository
     */
    private $repository;

    public function __construct( EloquentRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id         = Uuid::uuid4();
        $name       = $request->input('nombre');
        $code       = $request->input('codigo');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createRutaCase = new CreateUseCase( $this->repository );
        $createRutaCase->__invoke(
            $Id,
            $name,
            $code,
            $idStatus,
            $user->getId(),
            $idClient
        );
    }
}
