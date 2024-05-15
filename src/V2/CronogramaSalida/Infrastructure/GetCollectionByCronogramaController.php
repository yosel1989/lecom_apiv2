<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\CronogramaSalida\Application\GetCollectionByCronogramaUseCase;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaList;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class GetCollectionByCronogramaController
{
    private EloquentCronogramaSalidaRepository $repository;

    public function __construct(EloquentCronogramaSalidaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): CronogramaSalidaList
    {
        $idCronograma = $request->id;
        $useCase = new GetCollectionByCronogramaUseCase($this->repository);
        return $useCase->__invoke($idCronograma);
    }

}
