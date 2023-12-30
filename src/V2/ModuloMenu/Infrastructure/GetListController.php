<?php


namespace Src\V2\ModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ModuloMenu\Application\GetListUseCase;
use Src\V2\ModuloMenu\Infrastructure\Repositories\EloquentModuloMenuRepository;

final class GetListController
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
    public function __invoke( Request $request ): array
    {
        $useCase = new GetListUseCase($this->repository);
        return $useCase->__invoke();
    }

}
