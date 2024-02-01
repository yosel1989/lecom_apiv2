<?php

declare(strict_types=1);

namespace Src\V2\Liquidacion\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoInterprovincial\Application\GetReporteTotalByClienteFechagGroupVehiculoUseCase;
use Src\V2\BoletoInterprovincial\Application\GetReporteTotalByClienteFechaUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;
use Src\V2\Egreso\Application\GetListByClienteGroupTipoFechaUseCase;
use Src\V2\Egreso\Application\GetListByClienteGroupTipoFechaVehiculoUseCase;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;
use Src\V2\EgresoTipo\Application\GetListByClienteUseCase;
use Src\V2\EgresoTipo\Infrastructure\Repositories\EloquentEgresoTipoRepository;
use Src\V2\Liquidacion\Domain\Liquidacion;
use Src\V2\Vehiculo\Application\GetListByClienteArrayUseCase;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class GetReporteByClienteController
{
    private EloquentBoletoInterprovincialRepository $boletoInterprovincialRepository;
    private EloquentEgresoTipoRepository $egresoTipoRepository;
    private EloquentEgresoRepository $egresoRepository;
    private EloquentVehiculoRepository $vehiculoRepository;

    public function __construct(
        EloquentBoletoInterprovincialRepository $boletoInterprovincialRepository,
        EloquentEgresoTipoRepository $egresoTipoRepository,
        EloquentEgresoRepository $egresoRepository,
        EloquentVehiculoRepository $vehiculoRepository,
    )
    {
        $this->boletoInterprovincialRepository = $boletoInterprovincialRepository;
        $this->egresoTipoRepository = $egresoTipoRepository;
        $this->egresoRepository = $egresoRepository;
        $this->vehiculoRepository = $vehiculoRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Liquidacion
    {
        $user = Auth::user();
//        $idUsuario = $user->getId();

        $_idCliente = new Id($request->input('idCliente'), false, 'El id del cliente no tiene el formato correcto');
        $_fechaDesde = new DateFormat($request->input('fechaDesde'), false, 'La fecha inicial no tiene el formato correcto');
        $_fechaHasta = new DateFormat($request->input('fechaHasta'), false, 'La fecha final no tiene el formato correcto');
        $_periodoFecha = new \DatePeriod(
            new \DateTime($_fechaDesde->value()),
            new \DateInterval('P1D'),
            new \DateTime($_fechaHasta->value() . ' 23:59:59')
        );

        $egresoTipoUseCase = new GetListByClienteUseCase($this->egresoTipoRepository);
        $_egresoTipos = $egresoTipoUseCase->__invoke($_idCliente->value());

        $egresoUseCase = new GetListByClienteGroupTipoFechaUseCase($this->egresoRepository);
        $_egresoTotal = $egresoUseCase->__invoke($_idCliente->value(), $_fechaDesde->value(), $_fechaHasta->value());

        $egresoVehiculoUseCase = new GetListByClienteGroupTipoFechaVehiculoUseCase($this->egresoRepository);
        $_egresoVehiculo = $egresoVehiculoUseCase->__invoke($_idCliente->value(), $_fechaDesde->value(), $_fechaHasta->value());

        $vehiculoUseCase = new GetListByClienteArrayUseCase($this->vehiculoRepository);
        $_vehiculos = $vehiculoUseCase->__invoke($_idCliente->value(), ['c241a502-2448-448c-80ca-c51a7c4abddf', '085e8b03-5219-459c-80cb-997e52fcdd24']);

        $boletoInterprovincialTotalUseCase = new GetReporteTotalByClienteFechaUseCase($this->boletoInterprovincialRepository);
        $_ingresoTotalBoleto = $boletoInterprovincialTotalUseCase->__invoke($_idCliente->value(), $_fechaDesde->value(), $_fechaHasta->value());

        $boletoInterprovincialPorVehiculoUseCase = new GetReporteTotalByClienteFechagGroupVehiculoUseCase($this->boletoInterprovincialRepository);
        $_ingresoTotalBoletoVehiculo = $boletoInterprovincialPorVehiculoUseCase->__invoke($_idCliente->value(), $_fechaDesde->value(), $_fechaHasta->value());

        return new Liquidacion(
            $_idCliente,
            $_fechaDesde,
            $_fechaHasta,
            $_periodoFecha,
            $_egresoTipos,
            $_egresoTotal,
            $_egresoVehiculo,
            $_ingresoTotalBoleto,
            $_ingresoTotalBoletoVehiculo,
            $_vehiculos
        );

    }

}
