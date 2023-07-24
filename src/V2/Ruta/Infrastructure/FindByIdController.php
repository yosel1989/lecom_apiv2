<?php


namespace Src\V2\Ruta\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Ruta\Application\FindByIdUseCase;
use Src\V2\Ruta\Domain\Ruta;
use Src\V2\Ruta\Infrastructure\Repositories\EloquentRutaRepository;

final class FindByIdController
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
    public function __invoke( Request $request ): Ruta
    {
        $idRuta = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idRuta);
    }

}
