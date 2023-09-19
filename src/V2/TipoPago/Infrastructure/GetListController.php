<?php


namespace Src\V2\TipoPago\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\TipoPago\Application\GetListUseCase;
use Src\V2\TipoPago\Infrastructure\Repositories\EloquentTipoPagoRepository;

final class GetListController
{
    private EloquentTipoPagoRepository $repository;

    public function __construct(EloquentTipoPagoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): array
    {
        $useCase = new GetListUseCase($this->repository);
        return $useCase->__invoke();
    }

}
