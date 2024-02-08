<?php

namespace Src\V2\Liquidacion\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Liquidacion\Application\GetCollectionByClienteUseCase;
use Src\V2\Liquidacion\Domain\LiquidacionList;
use Src\V2\Liquidacion\Infrastructure\Repositories\EloquentLiquidacionRepository;

final class GetCollectionByClienteController
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
        $idCliente = $request->idCliente;
        $fechaDesde = $request->fechaDesde;
        $fechaHasta = $request->fechaHasta;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idCliente, $fechaDesde, $fechaHasta);
    }

}
