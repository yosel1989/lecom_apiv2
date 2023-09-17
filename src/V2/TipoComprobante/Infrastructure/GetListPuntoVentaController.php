<?php


namespace Src\V2\TipoComprobante\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\TipoComprobante\Application\GetListPuntoVentaUseCase;
use Src\V2\TipoComprobante\Infrastructure\Repositories\EloquentTipoComprobanteRepository;

final class GetListPuntoVentaController
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
        $useCase = new GetListPuntoVentaUseCase($this->repository);
        return $useCase->__invoke();
    }

}
