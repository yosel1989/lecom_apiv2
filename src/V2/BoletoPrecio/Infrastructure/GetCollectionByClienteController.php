<?php


namespace Src\V2\BoletoPrecio\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\BoletoPrecio\Application\GetCollectionByClienteUseCase;
use Src\V2\BoletoPrecio\Infrastructure\Repositories\EloquentBoletoPrecioRepository;

final class GetCollectionByClienteController
{
    private EloquentBoletoPrecioRepository $repository;

    public function __construct(EloquentBoletoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request, string $id, string $idRuta ): array
    {
        $idClient = $id;
        $_idRuta = $idRuta;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient, $_idRuta);
    }

}
