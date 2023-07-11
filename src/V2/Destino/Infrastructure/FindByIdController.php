<?php


namespace Src\V2\Destino\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Destino\Application\FindByIdUseCase;
use Src\V2\Destino\Domain\Destino;
use Src\V2\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class FindByIdController
{
    private EloquentDestinoRepository $repository;

    public function __construct(EloquentDestinoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Destino
    {
        $idDestino = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idDestino);
    }

}
