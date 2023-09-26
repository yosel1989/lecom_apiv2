<?php


namespace Src\V2\ComprobanteSerie\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ComprobanteSerie\Application\GetCollectionByClienteUseCase;
use Src\V2\ComprobanteSerie\Infrastructure\Repositories\EloquentComprobanteSerieRepository;

final class GetCollectionByClienteController
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
    public function __invoke( Request $request, string $id ): array
    {
        $idClient = $id;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
