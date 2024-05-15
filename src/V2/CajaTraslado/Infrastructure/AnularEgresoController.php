<?php


namespace Src\V2\CajaTraslado\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\CajaTraslado\Application\AnularCajaTrasladoUseCase;
use Src\V2\CajaTraslado\Application\FindByIdUseCase;
use Src\V2\CajaTraslado\Infrastructure\Repositories\EloquentCajaTrasladoRepository;
use Src\V2\CajaTrasladoEstadoMotivo\Application\CreateUseCase;
use Src\V2\CajaTrasladoEstadoMotivo\Infrastructure\Repositories\EloquentCajaTrasladoEstadoMotivoRepository;

final class AnularCajaTrasladoController
{
    private EloquentCajaTrasladoEstadoMotivoRepository $repositoryCajaTrasladoEstadoMotivo;
    private EloquentCajaTrasladoRepository $repository;

    public function __construct(
        EloquentCajaTrasladoRepository $repository,
        EloquentCajaTrasladoEstadoMotivoRepository $repositoryCajaTrasladoEstadoMotivo
    )
    {
        $this->repository = $repository;
        $this->repositoryCajaTrasladoEstadoMotivo = $repositoryCajaTrasladoEstadoMotivo;
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
            $idCajaTraslado = $request->input('id');
            $idCliente = $request->input('idCliente');
            $idMotivo = $request->input('idMotivo');

            $_idCajaTraslado = new Id($idCajaTraslado, false, 'El id del CajaTraslado no tiene el formato correcto');
            $_idCliente = new Id($idCliente, false, 'El id del cliente no tiene el formato correcto');
            $_idMotivo = new NumericInteger($idMotivo);

            $buscarCajaTrasladoUseCase = new FindByIdUseCase($this->repository);
            $_CajaTraslado = $buscarCajaTrasladoUseCase->__invoke($_idCajaTraslado->value());


            // Anular el CajaTraslado
            $useCase = new AnularCajaTrasladoUseCase($this->repository);
            $useCase->__invoke(
                $_idCajaTraslado->value(),
                $user->getId()
            );

            // Registrar motivo de anulacion
            $motivoAnulacionUseCase = new CreateUseCase($this->repositoryCajaTrasladoEstadoMotivo);
            $motivoAnulacionUseCase->__invoke($_CajaTraslado->getIdCliente()->value(), $_CajaTraslado->getId()->value(), $_idMotivo->value(), $user->getId());

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }

}
