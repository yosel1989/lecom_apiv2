<?php


namespace Src\V2\BoletoPrecio\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\BoletoPrecio\Application\FindByIdUseCase;
use Src\V2\BoletoPrecio\Domain\BoletoPrecio;
use Src\V2\BoletoPrecio\Infrastructure\Repositories\EloquentBoletoPrecioRepository;

final class FindByIdController
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
    public function __invoke( Request $request ): BoletoPrecio
    {
        $idBoletoPrecio = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idBoletoPrecio);
    }

}
