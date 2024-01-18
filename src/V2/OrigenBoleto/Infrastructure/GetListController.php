<?php


namespace Src\V2\OrigenBoleto\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\OrigenBoleto\Application\GetListUseCase;
use Src\V2\OrigenBoleto\Domain\OrigenBoletoShortList;
use Src\V2\OrigenBoleto\Infrastructure\Repositories\EloquentOrigenBoletoRepository;

final class GetListController
{
    private EloquentOrigenBoletoRepository $repository;

    public function __construct(EloquentOrigenBoletoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): OrigenBoletoShortList
    {
        $useCase = new GetListUseCase($this->repository);
        return $useCase->__invoke();
    }

}
