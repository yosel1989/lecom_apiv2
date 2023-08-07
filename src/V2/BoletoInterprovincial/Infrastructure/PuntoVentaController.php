<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoInterprovincial\Application\PuntoVentaUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class PuntoVentaController
{
    private EloquentBoletoInterprovincialRepository $repository;

    public function __construct(EloquentBoletoInterprovincialRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idCliente = $request->id;
        $idSede = $request->input('idSede');
        $idRuta = $request->input('idRuta');
        $idParadero = $request->input('idParadero');
        $precio = $request->input('precio');
        $idTipoDocumento = $request->input('idTipoDocumento');
        $numeroDocumento = $request->input('numeroDocumento');
        $nombre = $request->input('nombre');
        $direccion = $request->input('direccion');
        $useCase = new PuntoVentaUseCase($this->repository);
        $useCase->__invoke(
            $idCliente,
            $idSede,
            $idRuta,
            $idParadero,
            $precio,
            $idTipoDocumento,
            $numeroDocumento,
            $nombre,
            $direccion,
            $user->getId()
        );
    }

}
