<?php


namespace Src\V2\Cliente\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Cliente\Application\ChangeStateUseCase;
use Src\V2\Cliente\Infrastructure\Repositories\EloquentClienteRepository;

final class ChangeStateController
{
    private EloquentClienteRepository $repository;

    public function __construct(EloquentClienteRepository $repository)
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
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }

}
