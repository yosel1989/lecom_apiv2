<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\CronogramaSalida\Application\AnularCronogramaSalidaUseCase;
use Src\V2\CronogramaSalida\Application\FindByIdUseCase;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;
use Src\V2\CronogramaSalidaEstadoMotivo\Application\CreateUseCase;
use Src\V2\CronogramaSalidaEstadoMotivo\Infrastructure\Repositories\EloquentCronogramaSalidaEstadoMotivoRepository;

final class AnularCronogramaSalidaController
{
    private EloquentCronogramaSalidaEstadoMotivoRepository $repositoryCronogramaSalidaEstadoMotivo;
    private EloquentCronogramaSalidaRepository $repository;

    public function __construct(
        EloquentCronogramaSalidaRepository $repository,
        EloquentCronogramaSalidaEstadoMotivoRepository $repositoryCronogramaSalidaEstadoMotivo
    )
    {
        $this->repository = $repository;
        $this->repositoryCronogramaSalidaEstadoMotivo = $repositoryCronogramaSalidaEstadoMotivo;
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
            $idCronogramaSalida = $request->input('id');
            $idCliente = $request->input('idCliente');
            $idMotivo = $request->input('idMotivo');

            $_idCronogramaSalida = new Id($idCronogramaSalida, false, 'El id del CronogramaSalida no tiene el formato correcto');
            $_idCliente = new Id($idCliente, false, 'El id del cliente no tiene el formato correcto');
            $_idMotivo = new NumericInteger($idMotivo);

            $buscarCronogramaSalidaUseCase = new FindByIdUseCase($this->repository);
            $_CronogramaSalida = $buscarCronogramaSalidaUseCase->__invoke($_idCronogramaSalida->value());


            // Anular el CronogramaSalida
            $useCase = new AnularCronogramaSalidaUseCase($this->repository);
            $useCase->__invoke(
                $_idCronogramaSalida->value(),
                $user->getId()
            );

            // Registrar motivo de anulacion
            $motivoAnulacionUseCase = new CreateUseCase($this->repositoryCronogramaSalidaEstadoMotivo);
            $motivoAnulacionUseCase->__invoke($_CronogramaSalida->getIdCliente()->value(), $_CronogramaSalida->getId()->value(), $_idMotivo->value(), $user->getId());

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }

}
