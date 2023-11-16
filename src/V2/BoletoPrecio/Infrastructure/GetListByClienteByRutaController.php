<?php


namespace Src\V2\BoletoPrecio\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\BoletoPrecio\Application\GetListByClienteByRutaUseCase;
use Src\V2\BoletoPrecio\Infrastructure\Repositories\EloquentBoletoPrecioRepository;

final class GetListByClienteByRutaController
{
    private EloquentBoletoPrecioRepository $repository;

    public function __construct(EloquentBoletoPrecioRepository $repository)
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
