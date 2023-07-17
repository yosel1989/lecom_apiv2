<?php


namespace Src\V2\Cliente\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Cliente\Application\FindByIdUseCase;
use Src\V2\Cliente\Domain\Cliente;
use Src\V2\Cliente\Infrastructure\Repositories\EloquentClienteRepository;

final class FindByIdController
{
    private EloquentClienteRepository $repository;

    public function __construct(EloquentClienteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Cliente
    {
        $idCliente = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idCliente);
    }

}
