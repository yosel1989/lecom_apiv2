<?php

declare(strict_types=1);

namespace Src\V2\Liquidacion\Infrastructure;

use App\Exports\Documentos\LiquidacionExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use Ramsey\Uuid\Uuid;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Utility\Utilidades;
use Src\V2\BoletoInterprovincial\Application\GetLiquidacionTotalByVehiculoRangoFechaUseCase;
use Src\V2\BoletoInterprovincial\Application\LiberarLiquidacionUseCase;
use Src\V2\BoletoInterprovincial\Application\LiquidacionByVehiculoFechaGroupRutaBoletoUseCase;
use Src\V2\BoletoInterprovincial\Application\LiquidarBoletosInterprovincialesUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;
use Src\V2\Cliente\Application\FindByIdUseCase;
use Src\V2\Cliente\Domain\Cliente;
use Src\V2\Cliente\Infrastructure\Repositories\EloquentClienteRepository;
use Src\V2\Egreso\Application\GetLiquidacionEgresoTotalByVehiculoRangoFechaUseCase;
use Src\V2\Egreso\Application\GetListByClienteGroupTipoFechaUseCase;
use Src\V2\Egreso\Application\GetListByClienteGroupTipoFechaVehiculoUseCase;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;
use Src\V2\EgresoDetalle\Application\LiberarLiquidacionEgresoDetalleUseCase;
use Src\V2\EgresoDetalle\Application\LiquidarEgresoDetalleUseCase;
use Src\V2\EgresoDetalle\Infrastructure\Repositories\EloquentEgresoDetalleRepository;
use Src\V2\EgresoTipo\Application\GetListByClienteUseCase;
use Src\V2\EgresoTipo\Infrastructure\Repositories\EloquentEgresoTipoRepository;
use Src\V2\Liquidacion\Application\CreateUseCase;
use Src\V2\Liquidacion\Application\UltimoCodigoUseCase;
use Src\V2\Liquidacion\Domain\LiquidacionExcel;
use Src\V2\Liquidacion\Infrastructure\Repositories\EloquentLiquidacionRepository;
use Src\V2\Vehiculo\Application\GetListByClienteArrayUseCase;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class CreateController
{
    private EloquentLiquidacionRepository $repository;
    private EloquentClienteRepository $clienteRepository;
    private EloquentEgresoTipoRepository $egresoTipoRepository;
    private EloquentEgresoDetalleRepository $egresoDetalleRepository;
    private EloquentEgresoRepository $egresoRepository;
    private EloquentVehiculoRepository $vehiculoRepository;
    private EloquentBoletoInterprovincialRepository $boletoInterprovincialRepository;
    private $excel;


    public function __construct(
        Excel $excel,
        EloquentClienteRepository $clienteRepository,
        EloquentLiquidacionRepository $repository,
        EloquentEgresoTipoRepository $egresoTipoRepository,
        EloquentEgresoRepository $egresoRepository,
        EloquentVehiculoRepository $vehiculoRepository,
        EloquentBoletoInterprovincialRepository $boletoInterprovincialRepository,
        EloquentEgresoDetalleRepository $egresoDetalleRepository
    )
    {
        $this->egresoDetalleRepository = $egresoDetalleRepository;
        $this->clienteRepository = $clienteRepository;
        $this->repository = $repository;
        $this->egresoTipoRepository = $egresoTipoRepository;
        $this->egresoRepository = $egresoRepository;
        $this->vehiculoRepository = $vehiculoRepository;
        $this->boletoInterprovincialRepository = $boletoInterprovincialRepository;
        $this->excel = $excel;
    }

    public function __invoke( Request $request): void
    {
        DB::beginTransaction();

        try{
            $IdLiquidacion         = Uuid::uuid4();

            $user = Auth::user();
            $idCliente          = $request->input('idCliente');
            $idSede          = $request->input('idSede');
            $fechaDesde          = $request->input('fechaDesde');
            $fechaHasta          = $request->input('fechaHasta');
            $idVehiculos          = $request->input('idVehiculos');
            $idPersonal          = $request->input('idPersonal');

            $_idCliente = new Id($request->input('idCliente'), false, 'El id del cliente no tiene el formato correcto');
            $_idSede = new Id($request->input('idSede'), false, 'El id de la sede no tiene el formato correcto');
            $_fechaDesde = new DateFormat($request->input('fechaDesde'), false, 'La fecha inicial no tiene el formato correcto');
            $_fechaHasta = new DateFormat($request->input('fechaHasta'), false, 'La fecha final no tiene el formato correcto');

            // Generar periodo de fechas
            $_periodoFecha = new \DatePeriod(
                new \DateTime($_fechaDesde->value()),
                new \DateInterval('P1D'),
                new \DateTime($_fechaHasta->value() . ' 23:59:59')
            );

            // Obtener el cliente
            $buscarClienteUseCase = new FindByIdUseCase($this->clienteRepository);
            $cliente = $buscarClienteUseCase->__invoke($_idCliente->value());

            // Obtener ultimo codigo de liquidación del cliente
            $ultimoCodigoUseCase = new UltimoCodigoUseCase($this->repository);
            $_ultimoCodigo = $ultimoCodigoUseCase->__invoke($_idCliente->value());

            // Listar los tipos de egresos
            $egresoTipoUseCase = new GetListByClienteUseCase($this->egresoTipoRepository);
            $_egresoTipos = $egresoTipoUseCase->__invoke($_idCliente->value());

            // Obtener el total
            $egresoUseCase = new GetListByClienteGroupTipoFechaUseCase($this->egresoRepository);
            $_egresoTotal = $egresoUseCase->__invoke($_idCliente->value(), $_fechaDesde->value(), $_fechaHasta->value());

            // Obtener vehiculos
            $vehiculoUseCase = new GetListByClienteArrayUseCase($this->vehiculoRepository);
            $_vehiculos = $vehiculoUseCase->__invoke($_idCliente->value(), $idVehiculos);

            //Obtener egreso por vehiculo
            $egresoVehiculoUseCase = new GetListByClienteGroupTipoFechaVehiculoUseCase($this->egresoRepository);
            $_egresoVehiculo = $egresoVehiculoUseCase->__invoke($_idCliente->value(), $_fechaDesde->value(), $_fechaHasta->value());

            // Liquidación ingreso total agrupado por vehiculo y fecha
            $liquidacionTotalPorVehiculoYFechaUseCase = new GetLiquidacionTotalByVehiculoRangoFechaUseCase($this->boletoInterprovincialRepository);
            $liquidacionTotalPorVehiculoYFecha = $liquidacionTotalPorVehiculoYFechaUseCase->__invoke($_idCliente->value(), $idVehiculos, $_fechaDesde->value(), $_fechaHasta->value());

            // Liquidación egreso total agrupado por vehiculo y fecha
            $liquidacionEgresoTotalPorVehiculoYFechaUseCase = new GetLiquidacionEgresoTotalByVehiculoRangoFechaUseCase($this->egresoRepository);
            $liquidacionEgresoTotalPorVehiculoYFecha = $liquidacionEgresoTotalPorVehiculoYFechaUseCase->__invoke($_idCliente->value(), $idVehiculos, $_fechaDesde->value(), $_fechaHasta->value());


            // Liquidación ingreso por vehiculo, ruta, fecha
            $liquidacionVehiculoRutaFechaUseCase = new LiquidacionByVehiculoFechaGroupRutaBoletoUseCase($this->boletoInterprovincialRepository);
            $liquidacionVehiculoRutaFecha = $liquidacionVehiculoRutaFechaUseCase->__invoke($_idCliente->value(), $idVehiculos, $_fechaDesde->value(), $_fechaHasta->value());

            $liquidacion =  new LiquidacionExcel(
                $_ultimoCodigo,
                $_idCliente,
                $_fechaDesde,
                $_fechaHasta,
                $_periodoFecha,
                $_egresoTipos,
                $_egresoTotal,
                $_egresoVehiculo,
                $liquidacionTotalPorVehiculoYFecha,
                $liquidacionEgresoTotalPorVehiculoYFecha,
                $liquidacionVehiculoRutaFecha,
                $_vehiculos
            );

            $utilidades = new Utilidades();

            // Validar ruta para el archivo
            $this->validarCarpetaCliente($cliente);

            // Generar ruta para el archivo
            $path = sprintf('%s/liquidaciones/liquidacion_%s.xlsx', $_idCliente->value(), str_pad((string)($_ultimoCodigo->value()+1), 2, "0", STR_PAD_LEFT));
            $nombreArchivo = sprintf('liquidacion_%s.xlsx', str_pad((string)($_ultimoCodigo->value()+1), 2, "0", STR_PAD_LEFT));

            // Generar archivo excel y guardar
            $this->excel->store(
                new LiquidacionExport($liquidacion, $utilidades),
                $path,
                'public',
                null
            );

            // calcular totales
            $totalIngreso = 0;
            foreach ($liquidacion->getIngresoTotalBoleto()->all() as $item) {
                $totalIngreso +=  $item->getTotal()->value();
            }
            $totalEgreso = 0;
            foreach ($liquidacion->getEgresoTotalPorVehiculo() as $item) {
                $totalEgreso +=  $item->getTotal()->value();
            }

            // Liquidar los boletos
            $liquidarBoletosInterprovincialesUseCase = new LiquidarBoletosInterprovincialesUseCase($this->boletoInterprovincialRepository);
            $liquidarBoletosInterprovincialesUseCase->__invoke($_idCliente->value(), $IdLiquidacion->toString(), $_fechaDesde->value(), $_fechaHasta->value(), $idVehiculos);

            // Liquidar egresos
            $liquidarEgresoDetalleUseCase = new LiquidarEgresoDetalleUseCase($this->egresoDetalleRepository);
            $liquidarEgresoDetalleUseCase->__invoke($_idCliente->value(), $IdLiquidacion->toString(), $_fechaDesde->value(), $_fechaHasta->value(), $idVehiculos, $user->getId());


            $useCase = new CreateUseCase( $this->repository );
            $useCase->__invoke(
                $IdLiquidacion->toString(),
                $_ultimoCodigo->value()+1,
                $_idCliente->value(),
                $_idSede->value(),
                $idVehiculos,
                $idPersonal,
                $_fechaDesde->value(),
                $_fechaHasta->value(),
                $nombreArchivo,
                'uploads/'.$path,
                $user->getId(),
                true,
                ($totalIngreso - $totalEgreso)
            );

            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            throw new \InvalidArgumentException($e->getMessage());
        }

//
//
//
//
//        try {
//            $useCase = new CreateUseCase( $this->repository );
//            $useCase->__invoke(
//                $IdLiquidacion->toString(),
//                $_ultimoCodigo->value()+1,
//                $_idCliente->value(),
//                $_idSede->value(),
//                $idVehiculos,
//                $idPersonal,
//                $_fechaDesde->value(),
//                $_fechaHasta->value(),
//                $nombreArchivo,
//                'uploads/'.$path,
//                $user->getId(),
//                true,
//                ($totalIngreso - $totalEgreso)
//            );
//        }catch(\Exception $e){
//            // Liberar liquidacion de los boletos
//            $liberarLiquidacionBoletosInterprovincialesUseCase = new LiberarLiquidacionUseCase($this->boletoInterprovincialRepository);
//            $liberarLiquidacionBoletosInterprovincialesUseCase->__invoke($_idCliente->value(), $IdLiquidacion->toString());
//
//            // Liberar liquidacion de egresos detalle
//            $liberarLiquidacionEgresoDetalleUseCase = new LiberarLiquidacionEgresoDetalleUseCase($this->egresoDetalleRepository);
//            $liberarLiquidacionEgresoDetalleUseCase->__invoke($_idCliente->value(), $IdLiquidacion->toString(), $user->getId());
//
//            throw new \HttpInvalidParamException('No se pudo registrar la liquidación');
//        }



    }

    private function validarCarpetaCliente(Cliente $cliente): void{
        // verificar que la carpeta existe, sino crearla
        if(!file_exists(public_path("uploads"))){
            mkdir(public_path("uploads"), 666, true);
        }

        // verificar que la carpeta cliente, sino crearla
        if(!file_exists(public_path("uploads/" . $cliente->getId()->value()))){
            // Crear folder para el cliente
            mkdir(public_path("uploads/" . $cliente->getId()->value() ), 666, true);
            // Crear archivo de información
            $info = '';
            $info .= 'Id Cliente: ' . $cliente->getId()->value() . PHP_EOL;
            $info .= 'Código Cliente: ' . $cliente->getCodigo()->value() . PHP_EOL;
            $info .= 'Nombre Cliente: ' . $cliente->getNombre()->value() . PHP_EOL;
            $info .= 'Fecha Registro: ' . $cliente->getFechaRegistro()->value() . PHP_EOL;
            Storage::disk('public')->put($cliente->getId()->value() . "/info.txt" , $info);
        }

    }
}
