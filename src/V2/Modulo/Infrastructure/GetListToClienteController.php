<?php


namespace Src\V2\Modulo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Modulo\Application\GetListToClienteUseCase;
use Src\V2\Modulo\Infrastructure\Repositories\EloquentModuloRepository;

final class GetListToClienteController
{
    private EloquentModuloRepository $repository;

    public function __construct(EloquentModuloRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param string $idCliente
     * @return mixed
     */
    public function __invoke( Request $request, string $idCliente ): array
    {
        $useCase = new GetListToClienteUseCase($this->repository);
        return $useCase->__invoke($idCliente);
    }

}
