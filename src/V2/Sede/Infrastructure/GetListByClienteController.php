<?php


namespace Src\V2\Sede\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Sede\Application\GetListByClienteUseCase;
use Src\V2\Sede\Infrastructure\Repositories\EloquentSedeRepository;

final class GetListByClienteController
{
    private EloquentSedeRepository $repository;

    public function __construct(EloquentSedeRepository $repository)
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
