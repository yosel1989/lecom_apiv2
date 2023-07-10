<?php


namespace Src\V2\Modulo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Modulo\Application\GetListUseCase;
use Src\V2\Modulo\Infrastructure\Repositories\EloquentModuloRepository;

final class GetListController
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
    public function __invoke( Request $request ): array
    {
        $useCase = new GetListUseCase($this->repository);
        return $useCase->__invoke();
    }

}
