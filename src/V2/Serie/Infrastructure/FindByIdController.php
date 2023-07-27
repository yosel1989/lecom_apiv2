<?php


namespace Src\V2\Serie\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Serie\Application\FindByIdUseCase;
use Src\V2\Serie\Domain\Serie;
use Src\V2\Serie\Infrastructure\Repositories\EloquentSerieRepository;

final class FindByIdController
{
    private EloquentSerieRepository $repository;

    public function __construct(EloquentSerieRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Serie
    {
        $idSerie = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idSerie);
    }

}
