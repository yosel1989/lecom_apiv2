<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\CronogramaSalida\Application\FindByIdUseCase;
use Src\V2\CronogramaSalida\Domain\CronogramaSalida;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class FindByIdController
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
    public function __invoke( Request $request ): CronogramaSalida
    {
        $idCronogramaSalida = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idCronogramaSalida);
    }

}
