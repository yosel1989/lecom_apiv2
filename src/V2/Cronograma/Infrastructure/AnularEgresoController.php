<?php


namespace Src\V2\Cronograma\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Cronograma\Application\AnularCronogramaUseCase;
use Src\V2\Cronograma\Application\FindByIdUseCase;
use Src\V2\Cronograma\Infrastructure\Repositories\EloquentCronogramaRepository;
use Src\V2\CronogramaEstadoMotivo\Application\CreateUseCase;
use Src\V2\CronogramaEstadoMotivo\Infrastructure\Repositories\EloquentCronogramaEstadoMotivoRepository;

final class AnularCronogramaController
{
    private EloquentCronogramaEstadoMotivoRepository $repositoryCronogramaEstadoMotivo;
    private EloquentCronogramaRepository $repository;

    public function __construct(
        EloquentCronogramaRepository $repository,
        EloquentCronogramaEstadoMotivoRepository $repositoryCronogramaEstadoMotivo
    )
    {
        $this->repository = $repository;
        $this->repositoryCronogramaEstadoMotivo = $repositoryCronogramaEstadoMotivo;
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
            $idCronograma = $request->input('id');
            $idCliente = $request->input('idCliente');
            $idMotivo = $request->input('idMotivo');

            $_idCronograma = new Id($idCronograma, false, 'El id del Cronograma no tiene el formato correcto');
            $_idCliente = new Id($idCliente, false, 'El id del cliente no tiene el formato correcto');
            $_idMotivo = new NumericInteger($idMotivo);

            $buscarCronogramaUseCase = new FindByIdUseCase($this->repository);
            $_Cronograma = $buscarCronogramaUseCase->__invoke($_idCronograma->value());


            // Anular el Cronograma
            $useCase = new AnularCronogramaUseCase($this->repository);
            $useCase->__invoke(
                $_idCronograma->value(),
                $user->getId()
            );

            // Registrar motivo de anulacion
            $motivoAnulacionUseCase = new CreateUseCase($this->repositoryCronogramaEstadoMotivo);
            $motivoAnulacionUseCase->__invoke($_Cronograma->getIdCliente()->value(), $_Cronograma->getId()->value(), $_idMotivo->value(), $user->getId());

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }

}
