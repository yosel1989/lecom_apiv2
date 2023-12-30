<?php


namespace Src\V2\ModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ModuloMenu\Application\FindByIdUseCase;
use Src\V2\ModuloMenu\Domain\ModuloMenu;
use Src\V2\ModuloMenu\Infrastructure\Repositories\EloquentModuloMenuRepository;

final class FindByIdController
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
    public function __invoke( Request $request ): ModuloMenu
    {
        $idModuloMenu = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idModuloMenu);
    }

}
