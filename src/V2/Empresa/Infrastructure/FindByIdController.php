<?php


namespace Src\V2\Empresa\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Empresa\Application\FindByIdUseCase;
use Src\V2\Empresa\Domain\Empresa;
use Src\V2\Empresa\Infrastructure\Repositories\EloquentEmpresaRepository;

final class FindByIdController
{
    private EloquentEmpresaRepository $repository;

    public function __construct(EloquentEmpresaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Empresa
    {
        $idEmpresa = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idEmpresa);
    }

}
