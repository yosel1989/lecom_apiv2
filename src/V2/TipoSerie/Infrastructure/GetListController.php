<?php


namespace Src\V2\TipoSerie\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\TipoSerie\Application\GetListUseCase;
use Src\V2\TipoSerie\Infrastructure\Repositories\EloquentTipoSerieRepository;

final class GetListController
{
    private EloquentTipoSerieRepository $repository;

    public function __construct(EloquentTipoSerieRepository $repository)
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
