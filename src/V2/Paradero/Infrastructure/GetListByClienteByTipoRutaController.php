<?php


namespace Src\V2\Paradero\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Paradero\Application\GetListByClienteByTipoRutaUseCase;
use Src\V2\Paradero\Infrastructure\Repositories\EloquentParaderoRepository;

final class GetListByClienteByTipoRutaController
{
    private EloquentParaderoRepository $repository;

    public function __construct(EloquentParaderoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): array
    {
        $idClient = $request->id;
        $idTipoRuta = $request->idTipoRuta;
        $useCase = new GetListByClienteByTipoRutaUseCase($this->repository);
        return $useCase->__invoke($idClient, $idTipoRuta);
    }

}
