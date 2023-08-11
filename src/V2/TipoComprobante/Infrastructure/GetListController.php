<?php


namespace Src\V2\TipoComprobante\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\TipoComprobante\Application\GetListUseCase;
use Src\V2\TipoComprobante\Infrastructure\Repositories\EloquentTipoComprobanteRepository;

final class GetListController
{
    private EloquentTipoComprobanteRepository $repository;

    public function __construct(EloquentTipoComprobanteRepository $repository)
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
