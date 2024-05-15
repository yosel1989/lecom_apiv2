<?php

declare(strict_types=1);

namespace Src\V2\CajaTraslado\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Src\V2\CajaTraslado\Application\CreateUseCase;
use Src\V2\CajaTraslado\Domain\CajaTraslado;
use Src\V2\CajaTraslado\Infrastructure\Repositories\EloquentCajaTrasladoRepository;

final class CreateController
{
    private EloquentCajaTrasladoRepository $repository;

    public function __construct(
        EloquentCajaTrasladoRepository $repository
    )
    {
        $this->repository = $repository;

    }

    public function __invoke( Request $request): CajaTraslado
    {
        DB::beginTransaction();

        try{
            $Id         = Uuid::uuid4();

            $user = Auth::user();
            $idCliente          = $request->input('idCliente');
            $idSede          = $request->input('idSede');

            $idTipoComprobante = $request->input('idTipoComprobante');
            $idPersonal           = $request->input('idPersonal');


            $idCajaOrigen          = $request->input('idCajaOrigen');
            $idCajaDestino          = $request->input('idCajaDestino');
            $monto          = $request->input('monto');

            $useCase = new CreateUseCase( $this->repository );
            $_CajaTraslado =$useCase->__invoke(
                $Id->toString(),
                $idCliente,
                $idSede,
                $idTipoComprobante,
                $idPersonal,
                $idCajaOrigen,
                $idCajaDestino,
                $monto,
                $user->getId()
            );


            DB::commit();

            return $_CajaTraslado;
        }catch(\Exception $e){
            DB::rollBack();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }
}
