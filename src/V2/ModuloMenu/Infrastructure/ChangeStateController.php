<?php


namespace Src\V2\ModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\ModuloMenu\Application\ChangeStateUseCase;
use Src\V2\ModuloMenu\Infrastructure\Repositories\EloquentModuloMenuRepository;

final class ChangeStateController
{
    private EloquentModuloMenuRepository $repository;

    public function __construct(EloquentModuloMenuRepository $repository)
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
        $idModuloMenu = $request->idModuloMenu;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idModuloMenu,
            $idEstado,
            $user->getId()
        );
    }

}
