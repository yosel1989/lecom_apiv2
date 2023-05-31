<?php


namespace Src\Administracion\MotivoAnulacion\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\MotivoAnulacion\Application\UpdateUseCase;
use Src\Administracion\MotivoAnulacion\Infraestructure\Repositories\EloquentMotivoAnulacionRepository;

final class UpdateController
{

    /**
     * @var EloquentMotivoAnulacionRepository
     */
    private $repository;

    public function __construct( EloquentMotivoAnulacionRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id       = $request->id;
        $nombre       = $request->input('nombre');
        $idCliente   = $request->input('idCliente');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $Id,
            $nombre,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
