<?php


namespace Src\V2\Modulo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Modulo\Application\ChangeStateUseCase;
use Src\V2\Modulo\Infrastructure\Repositories\EloquentModuloRepository;

final class ChangeStateController
{
    private EloquentModuloRepository $repository;

    public function __construct(EloquentModuloRepository $repository)
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
        $idModulo = $request->idModulo;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idModulo,
            $idEstado,
            $user->getId()
        );
    }

}
