<?php


namespace Src\V2\CajaTraslado\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\CajaTraslado\Application\FindByIdUseCase;
use Src\V2\CajaTraslado\Domain\CajaTraslado;
use Src\V2\CajaTraslado\Infrastructure\Repositories\EloquentCajaTrasladoRepository;

final class FindByIdController
{
    private EloquentCajaTrasladoRepository $repository;

    public function __construct(EloquentCajaTrasladoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): CajaTraslado
    {
        $idCajaTraslado = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idCajaTraslado);
    }

}
