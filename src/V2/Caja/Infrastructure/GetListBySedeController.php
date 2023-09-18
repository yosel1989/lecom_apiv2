<?php


namespace Src\V2\Caja\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Caja\Application\GetListBySedeUseCase;
use Src\V2\Caja\Infrastructure\Repositories\EloquentCajaRepository;

final class GetListBySedeController
{
    private EloquentCajaRepository $repository;

    public function __construct(EloquentCajaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): array
    {
        $idCliente = $request->id;
        $idSede = $request->idSede;
        $useCase = new GetListBySedeUseCase($this->repository);
        return $useCase->__invoke($idCliente, $idSede);
    }

}
