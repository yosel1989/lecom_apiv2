<?php


namespace Src\V2\Liquidacion\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Liquidacion\Application\GetReporteDespachoByClienteUseCase;
use Src\V2\Liquidacion\Domain\LiquidacionList;
use Src\V2\Liquidacion\Infrastructure\Repositories\EloquentLiquidacionRepository;

final class GetReporteDespachoByClienteController
{
    private EloquentLiquidacionRepository $repository;

    public function __construct(EloquentLiquidacionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): LiquidacionList
    {
        $user = Auth::user();

        $idCliente = $request->id;
        $fecha = (new \DateTime('now'))->format('Y-m-d');
        $useCase = new GetReporteDespachoByClienteUseCase($this->repository);
        return $useCase->__invoke($idCliente, $user->getId(), $fecha);
    }

}
