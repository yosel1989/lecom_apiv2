<?php

namespace Src\V2\EgresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EgresoTipo\Application\GetListByClienteByCategoriaUseCase;
use Src\V2\EgresoTipo\Domain\EgresoTipoShortList;
use Src\V2\EgresoTipo\Infrastructure\Repositories\EloquentEgresoTipoRepository;

final class GetListByClienteByCategoriaController
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
    public function __invoke( Request $request ): EgresoTipoShortList
    {
        $idCliente = $request->id;
        $idCategoria= $request->idCategoria;
        $useCase = new GetListByClienteByCategoriaUseCase($this->repository);
        return $useCase->__invoke($idCliente, $idCategoria);
    }

}
