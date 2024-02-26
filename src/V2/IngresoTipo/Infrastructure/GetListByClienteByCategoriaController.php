<?php

namespace Src\V2\IngresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\IngresoTipo\Application\GetListByClienteByCategoriaUseCase;
use Src\V2\IngresoTipo\Domain\IngresoTipoShortList;
use Src\V2\IngresoTipo\Infrastructure\Repositories\EloquentIngresoTipoRepository;

final class GetListByClienteByCategoriaController
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
    public function __invoke( Request $request ): IngresoTipoShortList
    {
        $idCliente = $request->id;
        $idCategoria= $request->idCategoria;
        $useCase = new GetListByClienteByCategoriaUseCase($this->repository);
        return $useCase->__invoke($idCliente, $idCategoria);
    }

}
