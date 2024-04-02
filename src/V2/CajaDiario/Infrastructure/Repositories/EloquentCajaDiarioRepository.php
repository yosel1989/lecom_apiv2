<?php

declare(strict_types=1);

namespace Src\V2\CajaDiario\Infrastructure\Repositories;

use App\Enums\EnumEstadoCajaDiario;
use App\Models\V2\Caja;
use App\Models\V2\CajaDiario as EloquentModelCajaDiario;
use App\Models\V2\Cliente;
use App\Models\V2\EstadoCajaDiario;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\Caja\Domain\CajaSede;
use Src\V2\CajaDiario\Domain\CajaDiario;
use Src\V2\CajaDiario\Domain\CajaDiarioReporte;
use Src\V2\CajaDiario\Domain\Contracts\CajaDiarioRepositoryContract;

final class EloquentCajaDiarioRepository implements CajaDiarioRepositoryContract
{
    private EloquentModelCajaDiario $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelCajaDiario = new EloquentModelCajaDiario;
    }

    public function open(
        Id $idCaja,
        Id $idRuta,
        Id $idCliente,
        NumericFloat $montoInicial,
        DateTimeFormat $fechaApertura,
        Id $idUsuarioRegistro,
    ): void
    {
        $this->eloquentModelCajaDiario->create([
            'id_caja' =>  $idCaja->value(),
            'id_ruta' =>  $idRuta->value(),
            'id_cliente' =>  $idCliente->value(),
            'monto_inicial' =>  $montoInicial->value(),
            'f_apertura' =>  $fechaApertura->value(),
            'id_usu_registro' =>  $idUsuarioRegistro->value(),
        ]);
    }

    public function close(
        Id $idCaja,
        Id $idRuta,
        Id $idCliente,
        NumericFloat $montoFinal,
        DateTimeFormat $fechaCierre,
        Id $idUsuarioRegistro,
    ): void
    {
        $this->eloquentModelCajaDiario
            ->where('id_caja',$idCaja->value())
            ->where('id_ruta',$idRuta->value())
            ->where('id_cliente',$idCliente->value())
            ->firstOrFail()->update([
                'monto_final' =>  $montoFinal->value(),
                'f_cierre' =>  $fechaCierre->value(),
                'id_usu_modifico' =>  $idUsuarioRegistro->value(),
                'id_estado' => EnumEstadoCajaDiario::Cerrado->value
            ]);
    }

    public function abrir(
        Id $idCaja,
        Id $idCliente,
        NumericFloat $monto,
        Id $idUsuarioRegistro,
    ): string
    {
        $fecha = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $model = $this->eloquentModelCajaDiario->create([
            'id_caja' =>  $idCaja->value(),
            'id_cliente' =>  $idCliente->value(),
            'monto_inicial' =>  $monto->value(),
            'f_apertura' =>  $fecha,
            'id_usu_registro' =>  $idUsuarioRegistro->value(),
        ]);

        return $model->id;
    }

    public function cerrar(
        Id $idCaja,
        Id $idCliente,
        NumericFloat $monto,
        Id $idUsuarioRegistro,
    ): void
    {
        $fecha = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $select = $this->eloquentModelCajaDiario
            ->where('id_caja',$idCaja->value())
            ->where('id_cliente',$idCliente->value())
            ->whereNull('f_cierre');

        if($select->count() === 0){
            throw new \InvalidArgumentException('La caja ya se encuentra cerrada');
        }

        $select->firstOrFail()->update([
                'monto_final' =>  $monto->value(),
                'f_cierre' =>  $fecha,
                'id_usu_modifico' =>  $idUsuarioRegistro->value(),
                'id_estado' => EnumEstadoCajaDiario::Cerrado->value
            ]);
    }

    public function cerrarCajaDespacho(
        Id $idCaja,
        Id $idCajaDiario,
        Id $idCliente,
        NumericFloat $monto,
        Id $idUsuarioRegistro,
    ): void
    {
        $fecha = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $select = $this->eloquentModelCajaDiario
            ->where('id',$idCajaDiario->value())
            ->where('id_caja',$idCaja->value())
            ->where('id_cliente',$idCliente->value())
            ->whereNull('f_cierre');

        if($select->count() === 0){
            throw new \InvalidArgumentException('La caja ya se encuentra cerrada');
        }

        $select->firstOrFail()->update([
            'monto_final' =>  $monto->value(),
            'f_cierre' =>  $fecha,
            'id_usu_modifico' =>  $idUsuarioRegistro->value(),
            'id_estado' => EnumEstadoCajaDiario::Cerrado->value
        ]);
    }



    public function reporte(
        Id $idCliente,
        DateFormat $fechaInicio,
        DateFormat $fechaFinal
    ): array
    {
        $collection = [];

        $result = $this->eloquentModelCajaDiario
            ->with(
                'caja:id,nombre',
                'ruta:id,nombre',
                'usuarioRegistro:id,nombres,apellidos',
                'usuarioModifico:id,nombres,apellidos',
                'estado:id,nombre',
            )
            ->where('id_cliente',$idCliente->value())
            ->whereDate('f_apertura', '>=', $fechaInicio->value())
            ->whereDate('f_apertura', '<=', $fechaFinal->value())
            ->orderBy('f_apertura','DESC')
            ->get();

        foreach ($result as $model) {
            $OModel = new CajaDiarioReporte(
                new Id($model->id, false,  'El id no tiene el formato correcto'),
                new Id($model->id_cliente, false,  'E id del cliente no tiene el formato correcto'),
                new Id($model->id_caja, false,  'El id de la caja no tiene el formato correcto'),
                new Id(null, true, ''),
                new Id($model->id_usu_registro, false, 'El id del usuario que aperturo la caja no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true,  'El id del usuario que cerro la caja no tiene el formato correcto'),
                new DateTimeFormat($model->f_apertura, false, 'La fecha de apertura no tiene el formato correcto'),
                new DateTimeFormat($model->f_cierre, true, 'La fecha de cierre no tiene el formato correcto'),
                new NumericFloat($model->monto_inicial),
                new NumericFloat($model->monto_final),
                new NumericInteger($model->id_estado)
            );
            $OModel->setUsuarioAperturo(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioCerro(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setEstado(new Text( $model->estado->nombre , true, -1));
            $OModel->setCaja(new Text( $model->caja->nombre , true, -1));

            $collection[] = $OModel;
        }

        return $collection;
    }


    public function montoActual(
        Id $idCaja,
        Id $idCliente
    ): CajaSede
    {
        $collection = [];

        $Cliente = Cliente::findOrFail($idCliente->value(), ['id','codigo']);
        $Caja = Caja::findOrFail($idCaja->value(), ['id','nombre','id_sede']);

        $result = $this->eloquentModelCajaDiario
            ->select(
                'caja_diario.*',
//                DB::raw("
//                caja_diario.monto_inicial +
//                COALESCE((SELECT SUM(importe) FROM ingreso WHERE id_caja_diario = caja_diario.id), 0) -
//                COALESCE((SELECT SUM(egreso_detalle.importe) FROM egreso INNER JOIN egreso_detalle on egreso.id = egreso_detalle.id_egreso WHERE id_caja_diario = caja_diario.id),0) +
//                COALESCE((SELECT SUM(precio) FROM boleto_interprovincial_cliente_".$Cliente->codigo." WHERE id_caja_diario = caja_diario.id),0)
//                as saldo")
                "caja_diario.monto_inicial as saldo"
            )
            ->with(
                'caja:id,nombre',
                'estado:id,nombre',
            )
            ->where('id_cliente',$idCliente->value())
            ->where('id_caja',$idCaja->value())
//            ->whereDate('f_apertura', '>=', $fechaInicio->value())
//            ->whereDate('f_apertura', '<=', $fechaFinal->value())
            ->orderBy('f_apertura','DESC')
            ->offset(0)->limit(1)->get();

        if($result->count() === 1){
            $model = $result->first();

            $OModel = new CajaSede(
                new Id($model->id_caja, false, 'El id de la caja no tiene el formato correcto'),
                new Text($Caja->nombre, false, -1, ''),
                $idCliente,
                new Id($Caja->id_sede, false, 'El id de la sede no tiene el formato correcto')
            );
            $OModel->setAperturado(new ValueBoolean(is_null($model->f_cierre)));
            $OModel->setIdCajaDiario(new Id($model->id, false, 'El id del historial de caja no tiene el formato correcto'));
            $OModel->setIdEstado(new NumericInteger(is_null($model->f_cierre) ? EnumEstadoCajaDiario::Abierto->value : EnumEstadoCajaDiario::Cerrado->value));

            $Estado = EstadoCajaDiario::findOrFail($OModel->getIdEstado()->value());
            $OModel->setEstado(new Text($Estado->nombre, false, -1, ''));
            $OModel->setFechaApertura(new DateTimeFormat($model->f_apertura, false,  ''));
            $OModel->setSaldo(new NumericFloat($model->saldo));

//            dd($OModel);

            return $OModel;

        }

        throw new \InvalidArgumentException('Ocurrio un error');

    }

    public function reporteSaldo(
        Id $idCliente,
        DateFormat $fechaInicio,
        DateFormat $fechaFinal,
        Id $idCaja
    ): array
    {
        $collection = [];

        $Cliente = Cliente::findOrFail($idCliente);

        $result = $this->eloquentModelCajaDiario
            ->select(
                'caja_diario.*',
                DB::raw("
                COALESCE((SELECT SUM(importe) FROM ingreso WHERE id_caja_diario = caja_diario.id), 0) -
                COALESCE((SELECT SUM(egreso_detalle.importe) FROM egreso INNER JOIN egreso_detalle on egreso.id = egreso_detalle.id_egreso WHERE id_caja_diario = caja_diario.id),0) +
                COALESCE((SELECT SUM(precio) FROM boleto_interprovincial_cliente_".$Cliente->codigo." WHERE id_caja_diario = caja_diario.id),0)
                as saldo")
            )
            ->with(
                'caja:id,nombre',
                'ruta:id,nombre',
                'usuarioRegistro:id,nombres,apellidos',
                'usuarioModifico:id,nombres,apellidos',
                'estado:id,nombre',
            )
            ->where('id_cliente',$idCliente->value())
            ->whereDate('f_apertura', '>=', $fechaInicio->value())
            ->whereDate('f_apertura', '<=', $fechaFinal->value())
            ->orderBy('f_apertura','DESC');

        if(!is_null($idCaja->value())){
            $result = $result->where('id_caja',$idCaja->value());
        }

        $result = $result->get();

        foreach ($result as $model) {
            $OModel = new CajaDiarioReporte(
                new Id($model->id, false,  'El id no tiene el formato correcto'),
                new Id($model->id_cliente, false,  'E id del cliente no tiene el formato correcto'),
                new Id($model->id_caja, false,  'El id de la caja no tiene el formato correcto'),
                new Id(null, true, ''),
                new Id($model->id_usu_registro, false, 'El id del usuario que aperturo la caja no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true,  'El id del usuario que cerro la caja no tiene el formato correcto'),
                new DateTimeFormat($model->f_apertura, false, 'La fecha de apertura no tiene el formato correcto'),
                new DateTimeFormat($model->f_cierre, true, 'La fecha de cierre no tiene el formato correcto'),
                new NumericFloat($model->monto_inicial),
                new NumericFloat($model->monto_final),
                new NumericInteger($model->id_estado)
            );
            $OModel->setUsuarioAperturo(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioCerro(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setEstado(new Text( $model->estado->nombre , true, -1));
            $OModel->setCaja(new Text( $model->caja->nombre , true, -1));
            $OModel->setSaldo(new NumericFloat( $model->saldo));

            $collection[] = $OModel;
        }


        return $collection;
    }

}
