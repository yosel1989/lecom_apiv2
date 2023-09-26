<?php


namespace Src\V2\ComprobanteSerie\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ComprobanteSerie\Application\FindByIdUseCase;
use Src\V2\ComprobanteSerie\Domain\ComprobanteSerie;
use Src\V2\ComprobanteSerie\Infrastructure\Repositories\EloquentComprobanteSerieRepository;

final class FindByIdController
{
    private EloquentComprobanteSerieRepository $repository;

    public function __construct(EloquentComprobanteSerieRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): ComprobanteSerie
    {
        $idComprobanteSerie = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idComprobanteSerie);
    }

}
