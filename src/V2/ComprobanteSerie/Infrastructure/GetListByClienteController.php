<?php


namespace Src\V2\ComprobanteSerie\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ComprobanteSerie\Application\GetListByClienteUseCase;
use Src\V2\ComprobanteSerie\Infrastructure\Repositories\EloquentComprobanteSerieRepository;

final class GetListByClienteController
{
    private EloquentComprobanteSerieRepository $repository;

    public function __construct(EloquentComprobanteSerieRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): array
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetListByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
