<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\CronogramaSalida\Application\GetCollectionByRutaUseCase;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaList;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class GetCollectionByRutaController
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
        $useCase = new GetCollectionByRutaUseCase($this->repository);
        return $useCase->__invoke($idCronograma);
    }

}
