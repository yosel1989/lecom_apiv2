<?php


namespace Src\Administracion\Liquidacion\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\Liquidacion\Application\GetCollectionByClientByDateRangeUseCase;
use Src\Administracion\Liquidacion\Infraestructure\Repositories\EloquentLiquidacionRepository;

final class GetCollectionByClientByDateRangeController
{

    /**
     * @var EloquentLiquidacionRepository
     */
    private $repository;

    public function __construct( EloquentLiquidacionRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;
        $fechaDesde       = $request->fechaDesde;
        $fechaHasta       = $request->fechaHasta;

        $createParaderoCase = new GetCollectionByClientByDateRangeUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id,
            $fechaDesde,
            $fechaHasta
        );
    }
}
