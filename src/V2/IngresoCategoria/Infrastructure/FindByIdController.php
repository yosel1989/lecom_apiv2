<?php


namespace Src\V2\IngresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\IngresoCategoria\Application\FindByIdUseCase;
use Src\V2\IngresoCategoria\Domain\IngresoCategoria;
use Src\V2\IngresoCategoria\Infrastructure\Repositories\EloquentIngresoCategoriaRepository;

final class FindByIdController
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
    public function __invoke( Request $request ): IngresoCategoria
    {
        $idIngresoCategoria = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idIngresoCategoria);
    }

}
