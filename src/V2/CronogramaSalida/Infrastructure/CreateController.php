<?php

declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Src\V2\CronogramaSalida\Application\CreateUseCase;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class CreateController
{
    private EloquentCronogramaSalidaRepository $repository;

    public function __construct(
        EloquentCronogramaSalidaRepository $repository,
    )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        DB::beginTransaction();

        try{
            $user = Auth::user();
            $idCliente          = $request->input('idCliente');
            $idCronograma          = $request->input('idCronograma');
            $idVehiculo          = $request->input('idVehiculo');
            $fecha          = $request->input('fecha');
            $hora          = $request->input('hora');
            $idEstado          = $request->input('idEstado');

            $useCase = new CreateUseCase( $this->repository );
            $useCase->__invoke(
                $idCliente,
                $idCronograma,
                $idVehiculo,
                $fecha,
                $hora,
                $idEstado,
                $user->getId()
            );

            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }
}
