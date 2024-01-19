<?php


namespace Src\V2\EgresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EgresoCategoria\Application\FindByIdUseCase;
use Src\V2\EgresoCategoria\Domain\EgresoCategoria;
use Src\V2\EgresoCategoria\Infrastructure\Repositories\EloquentEgresoCategoriaRepository;

final class FindByIdController
{
    private EloquentEgresoCategoriaRepository $repository;

    public function __construct(EloquentEgresoCategoriaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): EgresoCategoria
    {
        $idEgresoCategoria = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idEgresoCategoria);
    }

}
