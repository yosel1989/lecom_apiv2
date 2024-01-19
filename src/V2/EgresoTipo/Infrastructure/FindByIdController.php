<?php


namespace Src\V2\EgresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EgresoTipo\Application\FindByIdUseCase;
use Src\V2\EgresoTipo\Domain\EgresoTipo;
use Src\V2\EgresoTipo\Infrastructure\Repositories\EloquentEgresoTipoRepository;

final class FindByIdController
{
    private EloquentEgresoTipoRepository $repository;

    public function __construct(EloquentEgresoTipoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): EgresoTipo
    {
        $idEgresoTipo = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idEgresoTipo);
    }

}
