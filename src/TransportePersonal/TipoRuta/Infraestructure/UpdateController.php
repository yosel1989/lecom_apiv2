<?php


namespace Src\TransportePersonal\TipoRuta\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\TransportePersonal\TipoRuta\Application\UpdateUseCase;
use Src\TransportePersonal\TipoRuta\Infraestructure\Repositories\EloquentTipoRutaRepository;

final class UpdateController
{

    /**
     * @var EloquentTipoRutaRepository
     */
    private $repository;

    public function __construct( EloquentTipoRutaRepository $repository )
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

        $createTipoRutaCase = new UpdateUseCase( $this->repository );
        $createTipoRutaCase->__invoke(
            $Id,
            $name,
            $idStatus,
            $user->getId(),
            $idClient
        );
    }
}
