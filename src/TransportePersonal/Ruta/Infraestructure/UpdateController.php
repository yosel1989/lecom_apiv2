<?php


namespace Src\TransportePersonal\Ruta\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\TransportePersonal\Ruta\Application\UpdateUseCase;
use Src\TransportePersonal\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class UpdateController
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
        $Id       = $request->id;
        $name       = $request->input('nombre');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createRutaCase = new UpdateUseCase( $this->repository );
        $createRutaCase->__invoke(
            $Id,
            $name,
            $idStatus,
            $user->getId(),
            $idClient
        );
    }
}
