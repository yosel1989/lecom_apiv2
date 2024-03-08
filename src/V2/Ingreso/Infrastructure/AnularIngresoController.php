<?php


namespace Src\V2\Ingreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Ingreso\Application\AnularIngresoUseCase;
use Src\V2\Ingreso\Application\FindByIdUseCase;
use Src\V2\Ingreso\Infrastructure\Repositories\EloquentIngresoRepository;
use Src\V2\IngresoEstadoMotivo\Application\CreateUseCase;
use Src\V2\IngresoEstadoMotivo\Infrastructure\Repositories\EloquentIngresoEstadoMotivoRepository;

final class AnularIngresoController
{
    private EloquentIngresoEstadoMotivoRepository $repositoryIngresoEstadoMotivo;
    private EloquentIngresoRepository $repository;

    public function __construct(
        EloquentIngresoRepository $repository,
        EloquentIngresoEstadoMotivoRepository $repositoryIngresoEstadoMotivo
    )
    {
        $this->repository = $repository;
        $this->repositoryIngresoEstadoMotivo = $repositoryIngresoEstadoMotivo;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): void
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $idIngreso = $request->input('id');
            $idCliente = $request->input('idCliente');
            $idMotivo = $request->input('idMotivo');

            $_idIngreso = new Id($idIngreso, false, 'El id del ingreso no tiene el formato correcto');
            $_idCliente = new Id($idCliente, false, 'El id del cliente no tiene el formato correcto');
            $_idMotivo = new NumericInteger($idMotivo);

            $buscarIngresoUseCase = new FindByIdUseCase($this->repository);
            $_ingreso = $buscarIngresoUseCase->__invoke($_idIngreso->value());


            // Anular el ingreso
            $useCase = new AnularIngresoUseCase($this->repository);
            $useCase->__invoke(
                $_idIngreso->value(),
                $user->getId()
            );

            // Registrar motivo de anulacion
            $motivoAnulacionUseCase = new CreateUseCase($this->repositoryIngresoEstadoMotivo);
            $motivoAnulacionUseCase->__invoke($_ingreso->getIdCliente()->value(), $_ingreso->getId()->value(), $_idMotivo->value(), $user->getId());

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }

}
