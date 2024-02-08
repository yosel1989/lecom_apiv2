<?php


namespace Src\V2\Liquidacion\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Liquidacion\Application\FindByIdUseCase;
use Src\V2\Liquidacion\Domain\Liquidacion;
use Src\V2\Liquidacion\Infrastructure\Repositories\EloquentLiquidacionRepository;

final class FindByIdController
{
    private EloquentLiquidacionRepository $repository;

    public function __construct(EloquentLiquidacionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Liquidacion
    {
        $idLiquidacion = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idLiquidacion);
    }

}
