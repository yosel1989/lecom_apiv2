<?php


namespace Src\Administracion\Egreso\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\Egreso\Application\AnularUseCase;
use Src\Administracion\Egreso\Infraestructure\Repositories\EloquentEgresoRepository;

final class AnularController
{

    /**
     * @var EloquentEgresoRepository
     */
    private $repository;

    public function __construct( EloquentEgresoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id       = $request->id;
        $idMotivo       = $request->input('idMotivo');
        $detalle       = $request->input('detalle');

        $useCase = new AnularUseCase( $this->repository );
        $useCase->__invoke(
            $Id,
            $idMotivo,
            $detalle,
            $user->getId()
        );
    }
}
