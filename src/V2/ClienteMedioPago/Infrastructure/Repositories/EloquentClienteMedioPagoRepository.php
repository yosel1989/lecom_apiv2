<?php

declare(strict_types=1);

namespace Src\V2\ClienteMedioPago\Infrastructure\Repositories;

use App\Models\V2\ClienteMedioPago as EloquentModelClienteMedioPago;
use App\Models\V2\MedioPago;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\ClienteMedioPago\Domain\ClienteMedioPago;
use Src\V2\ClienteMedioPago\Domain\Contracts\ClienteMedioPagoRepositoryContract;

final class EloquentClienteMedioPagoRepository implements ClienteMedioPagoRepositoryContract
{
    private EloquentModelClienteMedioPago $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelClienteMedioPago;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = MedioPago::with('tipo')->select(
            'medio_pago.id',
            'medio_pago.id_tipo',
            'nombre',
            \DB::raw(' CASE WHEN cliente_medio_pago.id_medio_pago IS NULL
                                THEN FALSE
                                ELSE TRUE
                        END AS blactivado'),
            \DB::raw("CONCAT(users.nombres,' ',users.apellidos) as usuarioRegistro"),
            'cliente_medio_pago.f_registro as fechaRegistro'
        )
            ->leftJoin('cliente_medio_pago', function($join) use ($idCliente){
            $join->on('medio_pago.id', '=', 'cliente_medio_pago.id_medio_pago')
                ->where('cliente_medio_pago.id_cliente', '=', $idCliente->value());
        })
        ->leftJoin('users', 'cliente_medio_pago.id_usu_registro', '=', 'users.id')
        ->get();

//        dd($models);

        $collection = [];

        foreach ( $models as $model ){

            $OModel = new ClienteMedioPago(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new Text($model->usuarioRegistro, true, -1, ''),
                new DateTimeFormat($model->fechaRegistro, true, 'La fecha de registro no tiene el formato correcto'),
                new ValueBoolean($model->blactivado),
            );
            $OModel->setIdTipo(new NumericInteger($model->tipo->id));
            $OModel->setTipo(new Text($model->tipo->nombre, false, -1, ''));

            $collection[] = $OModel;
        }

        return $collection;
    }



    public function changeState(
        Id $idCliente,
        NumericInteger $idMedioPago,
        ValueBoolean $idEstado,
        Id $idUsuarioModifico
    ): void{

        $current = new \DateTime('now');

//        dd($idEstado);

        if($idEstado->value()){
            $this->eloquent->create([
                'id_cliente' => $idCliente->value(),
                'id_medio_pago' => $idMedioPago->value(),
                'id_usu_registro' => $idUsuarioModifico->value(),
                'f_registro' => $current->format('Y-m-d H:i:s'),
            ]);
        }else{
            $this->eloquent->where('id_cliente', $idCliente->value())->where('id_medio_pago', $idMedioPago->value())->delete();
        }

    }


}
