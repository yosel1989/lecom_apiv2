<?php

namespace Src\Administracion\MotivoAnulacion\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Administracion\MotivoAnulacion\Application\CreateUseCase;
use Src\Administracion\MotivoAnulacion\Infraestructure\Repositories\EloquentMotivoAnulacionRepository;

final class CreateController
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
        $id         = Uuid::uuid4();
        $nombre       = $request->input('nombre');
        $idCliente   = $request->input('idCliente');
        $idEstado   = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $id,
            $nombre,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
