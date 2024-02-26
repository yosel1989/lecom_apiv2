<?php


namespace Src\V2\IngresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\IngresoCategoria\Application\ChangeStateUseCase;
use Src\V2\IngresoCategoria\Infrastructure\Repositories\EloquentIngresoCategoriaRepository;

final class ChangeStateController
{
    private EloquentIngresoCategoriaRepository $repository;

    public function __construct(EloquentIngresoCategoriaRepository $repository)
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
        $idIngresoCategoria = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idIngresoCategoria,
            $idEstado,
            $user->getId()
        );
    }

}
