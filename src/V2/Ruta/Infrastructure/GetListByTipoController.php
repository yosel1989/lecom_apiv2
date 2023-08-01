<?php


namespace Src\V2\Ruta\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Ruta\Application\GetListByTipoUseCase;
use Src\V2\Ruta\Infrastructure\Repositories\EloquentRutaRepository;

final class GetListByTipoController
{
    private EloquentRutaRepository $repository;

    public function __construct(EloquentRutaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request): array
    {
        $_idTipoRuta = $request->idTipoRuta;
        $_idCliente = $request->id;
        $useCase = new GetListByTipoUseCase($this->repository);
        return $useCase->__invoke($_idTipoRuta, $_idCliente);
    }

}
