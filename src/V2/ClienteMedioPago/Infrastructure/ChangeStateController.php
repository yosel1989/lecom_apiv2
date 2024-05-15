<?php


namespace Src\V2\ClienteMedioPago\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\ClienteMedioPago\Application\ChangeStateUseCase;
use Src\V2\ClienteMedioPago\Infrastructure\Repositories\EloquentClienteMedioPagoRepository;

final class ChangeStateController
{
    private EloquentClienteMedioPagoRepository $repository;

    public function __construct(EloquentClienteMedioPagoRepository $repository)
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
        $idCliente = $request->id;
        $idMedioPago = $request->idMedioPago;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idCliente,
            $idMedioPago,
            $idEstado,
            $user->getId()
        );
    }

}
