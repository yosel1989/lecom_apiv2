<?php


namespace Src\TransportePersonal\TipoRuta\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\TransportePersonal\TipoRuta\Application\CreateUseCase;
use Src\TransportePersonal\TipoRuta\Infraestructure\Repositories\EloquentTipoRutaRepository;

final class CreateController
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
        $Id         = Uuid::uuid4();
        $name       = $request->input('nombre');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createTipoRutaCase = new CreateUseCase( $this->repository );
        $createTipoRutaCase->__invoke(
            $Id,
            $name,
            $idStatus,
            $user->getId(),
            $idClient
        );
    }
}
