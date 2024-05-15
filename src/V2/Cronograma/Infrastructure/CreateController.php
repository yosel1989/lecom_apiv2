<?php

declare(strict_types=1);

namespace Src\V2\Cronograma\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Src\V2\Cronograma\Application\CreateUseCase;
use Src\V2\Cronograma\Infrastructure\Repositories\EloquentCronogramaRepository;

final class CreateController
{
    private EloquentCronogramaRepository $repository;

    public function __construct(
        EloquentCronogramaRepository $repository,
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
            $idSede          = $request->input('idSede');
            $idTipoRuta          = $request->input('idTipoRuta');
            $idRuta          = $request->input('idRuta');
            $fecha          = $request->input('fecha');
            $idEstado          = $request->input('idEstado');

            $useCase = new CreateUseCase( $this->repository );
            $useCase->__invoke(
                $idCliente,
                $idSede,
                $idTipoRuta,
                $idRuta,
                $fecha,
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
