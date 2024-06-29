<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\BoletoInterprovincial\Application\GetPasajerosByCronogramaSalidaUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class GetPasajerosByCronogramaSalidaController
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
        $idCronogramaSalida = $request->input('idCronogramaSalida');
        $idCliente = $request->input('idCliente');
        $useCase = new GetPasajerosByCronogramaSalidaUseCase($this->repository);
        return $useCase->__invoke($idCliente, $idCronogramaSalida);
    }

}
