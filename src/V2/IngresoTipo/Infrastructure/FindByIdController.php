<?php


namespace Src\V2\IngresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\IngresoTipo\Application\FindByIdUseCase;
use Src\V2\IngresoTipo\Domain\IngresoTipo;
use Src\V2\IngresoTipo\Infrastructure\Repositories\EloquentIngresoTipoRepository;

final class FindByIdController
{
    private EloquentIngresoTipoRepository $repository;

    public function __construct(EloquentIngresoTipoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): IngresoTipo
    {
        $idIngresoTipo = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idIngresoTipo);
    }

}
