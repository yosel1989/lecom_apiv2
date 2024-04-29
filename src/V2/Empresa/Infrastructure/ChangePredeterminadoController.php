<?php


namespace Src\V2\Empresa\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Empresa\Application\ChangePredeterminadoUseCase;
use Src\V2\Empresa\Infrastructure\Repositories\EloquentEmpresaRepository;

final class ChangePredeterminadoController
{
    private EloquentEmpresaRepository $repository;

    public function __construct(EloquentEmpresaRepository $repository)
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
        $idEmpresa = $request->id;
        $idCliente = $request->idCliente;
        $useCase = new ChangePredeterminadoUseCase($this->repository);
        $useCase->__invoke(
            $idCliente,
            $idEmpresa,
            $user->getId()
        );
    }

}
