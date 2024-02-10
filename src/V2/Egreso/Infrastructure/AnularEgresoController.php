<?php


namespace Src\V2\Egreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Egreso\Application\AnularEgresoUseCase;
use Src\V2\Egreso\Application\FindByIdUseCase;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;
use Src\V2\EgresoEstadoMotivo\Application\CreateUseCase;
use Src\V2\EgresoEstadoMotivo\Infrastructure\Repositories\EloquentEgresoEstadoMotivoRepository;

final class AnularEgresoController
{
    private EloquentEgresoEstadoMotivoRepository $repositoryEgresoEstadoMotivo;
    private EloquentEgresoRepository $repository;

    public function __construct(
        EloquentEgresoRepository $repository,
        EloquentEgresoEstadoMotivoRepository $repositoryEgresoEstadoMotivo
    )
    {
        $this->repository = $repository;
        $this->repositoryEgresoEstadoMotivo = $repositoryEgresoEstadoMotivo;
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
            $idEgreso = $request->input('id');
            $idCliente = $request->input('idCliente');
            $idMotivo = $request->input('idMotivo');

            $_idEgreso = new Id($idEgreso, false, 'El id del egreso no tiene el formato correcto');
            $_idCliente = new Id($idCliente, false, 'El id del cliente no tiene el formato correcto');
            $_idMotivo = new NumericInteger($idMotivo);

            $buscarEgresoUseCase = new FindByIdUseCase($this->repository);
            $_egreso = $buscarEgresoUseCase->__invoke($_idEgreso->value());


            // Anular el egreso
            $useCase = new AnularEgresoUseCase($this->repository);
            $useCase->__invoke(
                $_idEgreso->value(),
                $user->getId()
            );

            // Registrar motivo de anulacion
            $motivoAnulacionUseCase = new CreateUseCase($this->repositoryEgresoEstadoMotivo);
            $motivoAnulacionUseCase->__invoke($_egreso->getIdCliente()->value(), $_egreso->getId()->value(), $_idMotivo->value(), $user->getId());

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }

}
