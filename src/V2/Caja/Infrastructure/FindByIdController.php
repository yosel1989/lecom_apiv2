<?php


namespace Src\V2\Caja\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Caja\Application\FindByIdUseCase;
use Src\V2\Caja\Domain\Caja;
use Src\V2\Caja\Infrastructure\Repositories\EloquentCajaRepository;

final class FindByIdController
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
    public function __invoke( Request $request ): Caja
    {
        $idCaja = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idCaja);
    }

}
