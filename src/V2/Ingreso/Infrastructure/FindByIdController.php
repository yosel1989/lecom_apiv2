<?php


namespace Src\V2\Ingreso\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Ingreso\Application\FindByIdUseCase;
use Src\V2\Ingreso\Domain\Ingreso;
use Src\V2\Ingreso\Infrastructure\Repositories\EloquentIngresoRepository;

final class FindByIdController
{
    private EloquentIngresoRepository $repository;

    public function __construct(EloquentIngresoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Ingreso
    {
        $idIngreso = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idIngreso);
    }

}
