<?php


namespace Src\V2\EgresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\EgresoTipo\Application\ChangeStateUseCase;
use Src\V2\EgresoTipo\Infrastructure\Repositories\EloquentEgresoTipoRepository;

final class ChangeStateController
{
    private EloquentEgresoTipoRepository $repository;

    public function __construct(EloquentEgresoTipoRepository $repository)
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
        $idEgresoTipo = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idEgresoTipo,
            $idEstado,
            $user->getId()
        );
    }

}
