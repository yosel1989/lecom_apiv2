<?php


namespace Src\Administracion\Ingreso\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\Ingreso\Application\AnularUseCase;
use Src\Administracion\Ingreso\Infraestructure\Repositories\EloquentIngresoRepository;

final class AnularController
{

    /**
     * @var EloquentIngresoRepository
     */
    private $repository;

    public function __construct( EloquentIngresoRepository $repository )
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
