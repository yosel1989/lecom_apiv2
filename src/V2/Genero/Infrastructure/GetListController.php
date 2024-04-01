<?php


namespace Src\V2\Genero\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Genero\Application\GetListUseCase;
use Src\V2\Genero\Infrastructure\Repositories\EloquentGeneroRepository;

final class GetListController
{
    private EloquentGeneroRepository $repository;

    public function __construct(EloquentGeneroRepository $repository)
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
