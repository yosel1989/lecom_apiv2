<?php


namespace Src\V2\Egreso\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Egreso\Application\FindPdfByIdUseCase;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;

final class FindPdfByIdController
{
    private EloquentEgresoRepository $repository;

    public function __construct(
        EloquentEgresoRepository $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Egreso
    {
        $idEgreso = $request->id;
        $useCase = new FindPdfByIdUseCase($this->repository);
        $egreso = $useCase->__invoke($idEgreso);

        return $egreso;

    }

}
