<?php


namespace Src\V2\IngresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\IngresoCategoria\Application\GetCollectionByClienteUseCase;
use Src\V2\IngresoCategoria\Domain\IngresoCategoriaList;
use Src\V2\IngresoCategoria\Infrastructure\Repositories\EloquentIngresoCategoriaRepository;

final class GetCollectionByClienteController
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
    public function __invoke( Request $request ): IngresoCategoriaList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
