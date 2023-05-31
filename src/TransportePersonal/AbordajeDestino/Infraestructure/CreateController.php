<?php


namespace Src\TransportePersonal\AbordajeDestino\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\TransportePersonal\AbordajeDestino\Application\CreateUseCase;
use Src\TransportePersonal\AbordajeDestino\Infraestructure\Repositories\EloquentAbordajeDestinoRepository;

final class CreateController
{

    /**
     * @var EloquentAbordajeDestinoRepository
     */
    private $repository;

    public function __construct( EloquentAbordajeDestinoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id         = Uuid::uuid4();
        $IdVehiculo       = $request->has('idVehiculo') ? $request->input('idVehiculo') : null;
        $Matricula       = $request->input('matricula');
        $idRuta       = $request->has('idRuta') ? $request->input('idRuta') : null;
        $IdCliente       = $request->input('idCliente');
        $IdTipoRuta  = $request->input('idTipoRuta');
        $IdParaderoAbordaje   = $request->input('idParaderoAbordaje');
        $IdParaderoDestino   = $request->input('idParaderoDestino');
        $hora       = $request->has('hora') ? $request->input('hora') : null;

        $createAbordajeDestinoCase = new CreateUseCase( $this->repository );
        $createAbordajeDestinoCase->__invoke(
            $Id,
            $IdVehiculo,
            $Matricula,
            $IdCliente,
            $idRuta,
            $IdTipoRuta,
            $IdParaderoAbordaje,
            $IdParaderoDestino,
            $hora
        );
    }
}
