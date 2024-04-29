<?php


namespace Src\V2\Empresa\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Empresa\Application\ChangeStateUseCase;
use Src\V2\Empresa\Infrastructure\Repositories\EloquentEmpresaRepository;

final class ChangeStateController
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
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idEmpresa,
            $idEstado,
            $user->getId()
        );
    }

}
