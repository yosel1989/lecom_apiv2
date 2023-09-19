<?php


namespace Src\V2\TipoMoneda\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\TipoMoneda\Application\GetListUseCase;
use Src\V2\TipoMoneda\Infrastructure\Repositories\EloquentTipoMonedaRepository;

final class GetListController
{
    private EloquentTipoMonedaRepository $repository;

    public function __construct(EloquentTipoMonedaRepository $repository)
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
