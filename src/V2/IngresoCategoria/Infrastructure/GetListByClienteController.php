<?php


namespace Src\V2\IngresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\IngresoCategoria\Application\GetListByClienteUseCase;
use Src\V2\IngresoCategoria\Domain\IngresoCategoriaShortList;
use Src\V2\IngresoCategoria\Infrastructure\Repositories\EloquentIngresoCategoriaRepository;

final class GetListByClienteController
{
    private EloquentIngresoCategoriaRepository $repository;

    public function __construct(EloquentIngresoCategoriaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): IngresoCategoriaShortList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetListByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
