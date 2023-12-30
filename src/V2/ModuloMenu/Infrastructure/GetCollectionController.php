<?php


namespace Src\V2\ModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ModuloMenu\Application\GetCollectionUseCase;
use Src\V2\ModuloMenu\Infrastructure\Repositories\EloquentModuloMenuRepository;

final class GetCollectionController
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
    public function __invoke( Request $request, int $idModulo ): array
    {
        $useCase = new GetCollectionUseCase($this->repository);
        return $useCase->__invoke($idModulo);
    }

}
