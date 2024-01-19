<?php


namespace Src\V2\EgresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\EgresoCategoria\Application\ChangeStateUseCase;
use Src\V2\EgresoCategoria\Infrastructure\Repositories\EloquentEgresoCategoriaRepository;

final class ChangeStateController
{
    private EloquentEgresoCategoriaRepository $repository;

    public function __construct(EloquentEgresoCategoriaRepository $repository)
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
        $idEgresoCategoria = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idEgresoCategoria,
            $idEstado,
            $user->getId()
        );
    }

}
