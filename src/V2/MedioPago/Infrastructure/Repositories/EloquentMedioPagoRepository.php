<?php

declare(strict_types=1);

namespace Src\V2\MedioPago\Infrastructure\Repositories;

use App\Enums\EnuMedioPago;
use App\Models\V2\MedioPago as EloquentModelMedioPago;
use App\Models\V2\Cliente as EloquentModelCliente;
use App\Models\V2\CajaDiario as EloquentModelCajaDiario;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\MedioPago\Domain\Contracts\MedioPagoRepositoryContract;
use Src\V2\MedioPago\Domain\MedioPagoFlujo;
use Src\V2\MedioPago\Domain\MedioPagoShort;
use Src\V2\MedioPago\Domain\MedioPagoShortList;

final class EloquentMedioPagoRepository implements MedioPagoRepositoryContract
{
    private EloquentModelMedioPago $eloquent;
    private EloquentModelCliente $eloquentCliente;
    private EloquentModelCajaDiario $eloquentCajaDiario;

    public function __construct()
    {
        $this->eloquent = new EloquentModelMedioPago;
        $this->eloquentCliente = new EloquentModelCliente;
        $this->eloquentCajaDiario = new EloquentModelCajaDiario;
    }


    public function collectionToDespacho(): MedioPagoShortList
    {
        $models = $this->eloquent->select(
            'id',
            'nombre',
            'bl_entidad_financiera'
        )->where('bl_despacho', true)
            ->orderBy('nombre', 'asc')
            ->get();

        $collection = new MedioPagoShortList();

        foreach ( $models as $model ){

            $OModel = new MedioPagoShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new ValueBoolean($model->bl_entidad_financiera),
            );

            $collection->add($OModel);
        }

        return $collection;
    }


    public function collectionToCajaDiario(Id $idCliente, Id $idCajaDiario): MedioPagoShortList
    {
        $Cliente = $this->eloquentCliente->findOrFail($idCliente->value());

        $models = $this->eloquent->select(
            'id',
            'nombre',
            'bl_entidad_financiera'
        )->orderBy('nombre', 'asc')
            ->get();

        $collection = new MedioPagoShortList();

        foreach ( $models as $model ){

            $OModel = new MedioPagoShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new ValueBoolean($model->bl_entidad_financiera),
            );

            if($model->id == EnuMedioPago::Efectivo->value){
                $result = $this->eloquentCajaDiario->select(
                    DB::raw("caja_diario.monto_inicial +
                                    COALESCE((SELECT SUM(importe) FROM ingreso WHERE id_caja_diario = caja_diario.id AND id_medio_pago = ". $model->id ."), 0) -
                                    COALESCE((SELECT SUM(egreso_detalle.importe) FROM egreso INNER JOIN egreso_detalle on egreso.id = egreso_detalle.id_egreso WHERE id_caja_diario = caja_diario.id AND egreso_detalle.id_medio_pago = ". $model->id ."),0) +
                                    COALESCE((SELECT SUM(precio) FROM boleto_interprovincial_cliente_" . $Cliente->codigo . " WHERE id_caja_diario = caja_diario.id AND id_medio_pago = ". $model->id ."),0)
                                    as saldo"
                    )
                )->where('id', $idCajaDiario->value())->get();
            }else{
                $result = $this->eloquentCajaDiario->select(
                    DB::raw("COALESCE((SELECT SUM(importe) FROM ingreso WHERE id_caja_diario = caja_diario.id AND id_medio_pago = ". $model->id ."), 0) -
                                    COALESCE((SELECT SUM(egreso_detalle.importe) FROM egreso INNER JOIN egreso_detalle on egreso.id = egreso_detalle.id_egreso WHERE id_caja_diario = caja_diario.id AND egreso_detalle.id_medio_pago = ". $model->id ."),0) +
                                    COALESCE((SELECT SUM(precio) FROM boleto_interprovincial_cliente_" . $Cliente->codigo . " WHERE id_caja_diario = caja_diario.id AND id_medio_pago = ". $model->id ."),0)
                                    as saldo"
                    )
                )->where('id', $idCajaDiario->value())->get();
            }

            $OModel->setMonto(new NumericFloat($result->first()->saldo));


            $collection->add($OModel);
        }

        return $collection;
    }


    public function flujoToCajaDiario(Id $idCliente, Id $idCajaDiario): MedioPagoFlujo
    {
        $Cliente = $this->eloquentCliente->findOrFail($idCliente->value());

        $models = $this->eloquent->select(
            'id',
            'nombre',
            'bl_entidad_financiera'
        )->orderBy('nombre', 'asc')
            ->get();

        $ingresos = new MedioPagoShortList();
        $egresos = new MedioPagoShortList();

        foreach ( $models as $model ){

            $OModel = new MedioPagoShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new ValueBoolean($model->bl_entidad_financiera),
            );

            $egreso = $OModel;
            $ingreso = $OModel;

            $montoEgreso = $this->eloquentCajaDiario->select(
                DB::raw("COALESCE((SELECT SUM(egreso_detalle.importe) FROM egreso INNER JOIN egreso_detalle on egreso.id = egreso_detalle.id_egreso WHERE id_caja_diario = caja_diario.id AND egreso_detalle.id_medio_pago = ". $model->id ."),0) as saldo"
                )
            )->where('id', $idCajaDiario->value())->get();
            $egreso->setMonto(new NumericFloat($montoEgreso->first()->saldo));

            $montoIngreso = $this->eloquentCajaDiario->select(
                DB::raw("COALESCE((SELECT SUM(importe) FROM ingreso WHERE id_caja_diario = caja_diario.id AND id_medio_pago = ". $model->id ."), 0) +
                                    COALESCE((SELECT SUM(precio) FROM boleto_interprovincial_cliente_" . $Cliente->codigo . " WHERE id_caja_diario = caja_diario.id AND id_medio_pago = ". $model->id ."),0)
                                    as saldo"
                )
            )->where('id', $idCajaDiario->value())->get();
            $ingreso->setMonto(new NumericFloat($montoIngreso->first()->saldo));

            $ingresos->add($ingreso);
            $egresos->add($egreso);
        }

        $output = new MedioPagoFlujo(
            $ingresos,
            $egresos
        );

        return $output;
    }

}
