<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoInterprovincial\Application\GetReportePuntoVentaByClienteUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class GetReportePuntoVentaByClienteController
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

        $idCliente = $request->id;
        $fecha = (new \DateTime('now'))->format('Y-m-d');
        $useCase = new GetReportePuntoVentaByClienteUseCase($this->repository);
        return $useCase->__invoke($idCliente, $user->getId(), $fecha);
    }

}
