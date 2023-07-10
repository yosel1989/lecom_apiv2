<?php


namespace Src\V2\Modulo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Modulo\Application\FindByIdUseCase;
use Src\V2\Modulo\Domain\Modulo;
use Src\V2\Modulo\Infrastructure\Repositories\EloquentModuloRepository;

final class FindByIdController
{
    private EloquentModuloRepository $repository;

    public function __construct(EloquentModuloRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Modulo
    {
        $idModulo = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idModulo);
    }

}
