<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoInterprovincial\Application\GetReportByClienteUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class GetReportByClienteController
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
    public function __invoke( Request $request ): array
    {
        $user = Auth::user();

        $idClient = $request->id;
        $fechaDesde = $request->fechaDesde;
        $fechaHasta = $request->fechaHasta;
        $idRuta = $request->idRuta === 'null' ? null : $request->idRuta;
        $useCase = new GetReportByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient, $fechaDesde, $fechaHasta, $idRuta, $user->getId());
    }

}
