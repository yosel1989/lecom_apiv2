<?php


namespace Src\V2\Cronograma\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Cronograma\Application\GetCollectionByClienteUseCase;
use Src\V2\Cronograma\Domain\CronogramaList;
use Src\V2\Cronograma\Infrastructure\Repositories\EloquentCronogramaRepository;

final class GetCollectionByClienteController
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
    public function __invoke( Request $request ): CronogramaList
    {
        $idClient = $request->id;
        $useCase = new GetCollectionByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient);
    }

}
