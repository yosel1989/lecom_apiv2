<?php


namespace Src\V2\Liquidacion\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\BoletoInterprovincial\Application\LiberarLiquidacionUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;
use Src\V2\EgresoDetalle\Application\LiberarLiquidacionEgresoDetalleUseCase;
use Src\V2\EgresoDetalle\Infrastructure\Repositories\EloquentEgresoDetalleRepository;
use Src\V2\Liquidacion\Application\AnularLiquidacionUseCase;
use Src\V2\Liquidacion\Application\FindByIdUseCase;
use Src\V2\Liquidacion\Infrastructure\Repositories\EloquentLiquidacionRepository;
use Src\V2\LiquidacionEstadoMotivo\Application\CreateUseCase;
use Src\V2\LiquidacionEstadoMotivo\Infrastructure\Repositories\EloquentLiquidacionEstadoMotivoRepository;

final class AnularLiquidacionController
{
    private EloquentLiquidacionEstadoMotivoRepository $repositoryLiquidacionEstadoMotivo;
    private EloquentLiquidacionRepository $repository;
    private EloquentEgresoDetalleRepository $egresoDetallerepository;
    private EloquentBoletoInterprovincialRepository $eloquentBoletoInterprovincialRepository;

    public function __construct(
        EloquentLiquidacionRepository $repository,
        EloquentEgresoDetalleRepository $egresoDetallerepository,
        EloquentBoletoInterprovincialRepository $eloquentBoletoInterprovincialRepository,
        EloquentLiquidacionEstadoMotivoRepository $repositoryLiquidacionEstadoMotivo
    )
    {
        $this->repository = $repository;
        $this->egresoDetallerepository = $egresoDetallerepository;
        $this->eloquentBoletoInterprovincialRepository = $eloquentBoletoInterprovincialRepository;
        $this->repositoryLiquidacionEstadoMotivo = $repositoryLiquidacionEstadoMotivo;
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
            $idLiquidacion = $request->input('id');
            $idCliente = $request->input('idCliente');
            $idMotivo = $request->input('idMotivo');

            $_idLiquidacion = new Id($idLiquidacion, false, 'El id de la liquidación no tiene el formato correcto');
            $_idCliente = new Id($idCliente, false, 'El id del cliente no tiene el formato correcto');
            $_idMotivo = new NumericInteger($idMotivo);

            $buscarLiquidacionUseCase = new FindByIdUseCase($this->repository);
            $_liquidacion = $buscarLiquidacionUseCase->__invoke($_idLiquidacion->value());


            // Anular la liquidación
            $useCase = new AnularLiquidacionUseCase($this->repository);
            $useCase->__invoke(
                $_idLiquidacion->value(),
                $user->getId()
            );

            // Registrar motivo de anulacion
            $motivoAnulacionUseCase = new CreateUseCase($this->repositoryLiquidacionEstadoMotivo);
            $motivoAnulacionUseCase->__invoke($_liquidacion->getIdCliente()->value(), $_liquidacion->getId()->value(), $_idMotivo->value(), $user->getId());

            // Liberar liquidacion de los boletos
            $liberarLiquidacionBoletosInterprovincialesUseCase = new LiberarLiquidacionUseCase($this->eloquentBoletoInterprovincialRepository);
            $liberarLiquidacionBoletosInterprovincialesUseCase->__invoke($_idCliente->value(), $_idLiquidacion->value());

            // Liberar liquidacion de egresos detalle
            $liberarLiquidacionEgresoDetalleUseCase = new LiberarLiquidacionEgresoDetalleUseCase($this->egresoDetallerepository);
            $liberarLiquidacionEgresoDetalleUseCase->__invoke($_idCliente->value(), $_idLiquidacion->value(), $user->getId());

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }

}
