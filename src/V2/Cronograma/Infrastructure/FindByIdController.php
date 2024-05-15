<?php


namespace Src\V2\Cronograma\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Cronograma\Application\FindByIdUseCase;
use Src\V2\Cronograma\Domain\Cronograma;
use Src\V2\Cronograma\Infrastructure\Repositories\EloquentCronogramaRepository;

final class FindByIdController
{
    private EloquentCronogramaRepository $repository;

    public function __construct(EloquentCronogramaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Cronograma
    {
        $idCronograma = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idCronograma);
    }

}
