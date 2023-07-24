<?php


namespace Src\V2\TipoRuta\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\TipoRuta\Application\GetListUseCase;
use Src\V2\TipoRuta\Infrastructure\Repositories\EloquentTipoRutaRepository;

final class GetListController
{
    private EloquentTipoRutaRepository $repository;

    public function __construct(EloquentTipoRutaRepository $repository)
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
