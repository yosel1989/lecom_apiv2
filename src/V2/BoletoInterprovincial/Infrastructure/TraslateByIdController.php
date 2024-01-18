<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoInterprovincial\Application\TraslateByIdUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class TraslateByIdController
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
        $idMotivo = $request->input('idMotivo');

        $useCase = new TraslateByIdUseCase($this->repository);
         $useCase->__invoke($idCliente, $idVehiculo, $idBoletoInterprovincial, $user->getId(), $idMotivo);
    }

}
