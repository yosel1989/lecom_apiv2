<?php


namespace Src\V2\Paradero\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Paradero\Application\GetListByClienteByRutaUseCase;
use Src\V2\Paradero\Application\GetListByClienteUseCase;
use Src\V2\Paradero\Infrastructure\Repositories\EloquentParaderoRepository;

final class GetListByClienteByRutaController
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
        $idRuta = $request->idRuta;
        $useCase = new GetListByClienteByRutaUseCase($this->repository);
        return $useCase->__invoke($idClient, $idRuta);
    }

}
