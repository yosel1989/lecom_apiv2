<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\CronogramaSalida\Application\GetCollectionByClienteUseCase;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaList;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class GetCollectionByClienteController
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
        $idClient = $request->id;
        $useCase = new GetCollectionByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient);
    }

}
