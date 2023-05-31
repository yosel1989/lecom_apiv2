<?php


namespace Src\Administracion\Liquidacion\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\Liquidacion\Application\AnularUseCase;
use Src\Administracion\Liquidacion\Infraestructure\Repositories\EloquentLiquidacionRepository;

final class AnularController
{

    /**
     * @var EloquentLiquidacionRepository
     */
    private $repository;

    public function __construct( EloquentLiquidacionRepository $repository )
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
