<?php


namespace Src\V2\LogBoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\LogBoletoInterprovincial\Application\GetCollectionByClienteUseCase;
use Src\V2\LogBoletoInterprovincial\Domain\LogBoletoInterprovincialList;
use Src\V2\LogBoletoInterprovincial\Infrastructure\Repositories\EloquentLogBoletoInterprovincialRepository;

final class GetCollectionByClienteController
{
    private EloquentLogBoletoInterprovincialRepository $reLogBoletoInterprovincialitory;

    public function __construct(EloquentLogBoletoInterprovincialRepository $reLogBoletoInterprovincialitory)
    {
        $this->reLogBoletoInterprovincialitory = $reLogBoletoInterprovincialitory;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): LogBoletoInterprovincialList
    {
        $idClient = $request->id;
        $fecha = $request->fecha;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->reLogBoletoInterprovincialitory);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient, $fecha);
    }

}
