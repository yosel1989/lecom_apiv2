<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoInterprovincial\Application\ScanByIdUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class ScanByIdController
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
    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idCliente = $request->input('idCliente');
        $idVehiculo = $request->input('idVehiculo');
        $idBoletoInterprovincial = $request->input('idBoleto');

        $useCase = new ScanByIdUseCase($this->repository);
         $useCase->__invoke($idCliente, $idVehiculo, $idBoletoInterprovincial, $user->getId());
    }

}
