<?php

namespace Src\Administracion\Liquidacion\Infraestructure\Repositories;

use App\Models\Administracion\Liquidacion as EloquentLiquidacion;
use Illuminate\Support\Facades\DB;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;
use Src\Administracion\Liquidacion\Domain\Liquidacion;
use Exception;

final class EloquentLiquidacionRepository implements LiquidacionRepositoryContract
{
    /**
     * @var EloquentLiquidacion
     */
    private $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentLiquidacion;
    }

    public function create(
        Id $id,
        Numeric $IdTipoLiquidacion,
        DateOnlyFormat $fecha,
        DateOnlyFormat $fechaDesde,
        DateOnlyFormat $fechaHasta,
        Id $idVehiculo,
        Id $idPersonal,
        Text $observacion,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
//        throw new Exception($idVehiculo->value());

        $this->eloquent->create([
            'id' => $id->value(),
            'id_tipo_liquidacion' => $IdTipoLiquidacion->value(),
            'date' => $fecha->value(),
            'date_start' => $fechaDesde->value(),
            'date_end' => $fechaHasta->value(),
            'id_vehicle' => $idVehiculo->value(),
            'id_personal' => $idPersonal->value(),
//            'amount' => $monto->value(),
            'observation' => $observacion->value(),
            'id_client' => $idCliente->value(),
            'id_status' => $idEstado->value(),
            'id_user_created' => $idUsuarioRegistro->value()
        ]);

        $query = "call Adm_Interprov_LiquidacionDiariaBus('". $id->value() ."','". $fecha->value() ."','". $idVehiculo->value() ."','". $idCliente->value() ."','". $idUsuarioRegistro->value() ."')";
        $response = DB::select($query);
        $codeError = 0;
        $hasError = false;
        $messageError = '';

        foreach ( $response as $item ){

            $hasError = (bool)$item->TieneError;
            $codeError = (int)$item->Codigo;
            $messageError = $item->Mensaje;

        }

        if($hasError){
            throw new Exception($messageError, $codeError);
        }

    }

    public function cancel(
        Id $id,
        Id $idMotivo,
        Text $detalle,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
            'id_status' => 0,
            'id_user_updated' => $idUsuarioRegistro->value()
        ]);
    }

    public function collectionByClient(Id $idCliente): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name','vehicle:id,plate','personal:id,firstname,lastname')
            ->where('id_client',$idCliente->value())
            ->orderBy('created_at','desc')
            ->get();

        foreach( $response as $item) {
            $model = new Liquidacion(
                new Id($item->id,false,'El id del Liquidacion no tiene el formato valido'),
                new Numeric($item->id_tipo_liquidacion,false),
                new DateOnlyFormat($item->date,true,'La fecha tiene un formato invalido'),
                new DateOnlyFormat($item->date_start,true,'La fecha de inicio tiene un formato invalido'),
                new DateOnlyFormat($item->date_end,true,'La fecha fin tiene un formato invalido'),
                new Id($item->id_vehicle,true,'El id del vehiculo no tiene el formato valido'),
                new Id($item->id_personal,true,'El id del personal no tiene el formato valido'),
                new Numeric($item->amount,false),
                new Text($item->observation,true, 250,'La observación excede los 250 caracteres'),
                new Id($item->id_client,false,'El id del cliente no tiene el formato valido'),
                new Numeric($item->id_status,false),
                new Id($item->id_user_created,true,'El id del usuario que registro no tiene el formato valido'),
                new DateTimeFormat($item->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
                new Id($item->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
            );
            $model->setUsuarioRegistro(new Text(is_null($item->userCreated) ? null  : ($item->userCreated->first_name . ' ' . $item->userCreated->last_name) ,true, 500 ,'El nombre del usuario que registro excede los 500 caracteres'));
            $model->setUsuarioModifico(new Text(is_null($item->userUpdated) ? null  : ($item->userUpdated->first_name . ' ' . $item->userUpdated->last_name) ,true, 500 ,'El nombre del usuario que modifico excede los 500 caracteres'));
            $model->setVehiculo(new Text(is_null($item->vehicle) ? null  : ($item->vehicle->plate) ,true, 50 ,'El nombre del vehiculo  excede los 50 caracteres'));
            $model->setPersonal(new Text(is_null($item->personal) ? null  : ($item->personal->firstname . ' ' . $item->personal->lastname) ,true, 250 ,'El nombre del personal  excede los 250 caracteres'));
            $collection[] = $model;
        }

        return $collection;
    }

    public function collectionByClientByDateRange(Id $idCliente, DateOnlyFormat $fechaDesde, DateOnlyFormat $fechaHasta): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name','vehicle:id,plate','personal:id,firstname,lastname')
            ->where('id_client',$idCliente->value())
            ->whereDate('date_start', '>=',$fechaDesde->value())
            ->whereDate('date_end', '<=',$fechaHasta->value())
            ->get();

        foreach( $response as $item) {
            $model = new Liquidacion(
                new Id($item->id,false,'El id del Liquidacion no tiene el formato valido'),
                new Numeric($item->id_tipo_liquidacion,false),
                new DateOnlyFormat($item->date,true,'La fecha tiene un formato invalido'),
                new DateOnlyFormat($item->date_start,true,'La fecha de inicio tiene un formato invalido'),
                new DateOnlyFormat($item->date_end,true,'La fecha fin tiene un formato invalido'),
                new Id($item->id_vehicle,true,'El id del vehiculo no tiene el formato valido'),
                new Id($item->id_personal,true,'El id del personal no tiene el formato valido'),
                new Numeric($item->amount,false),
                new Text($item->observation,true, 250,'La observación excede los 250 caracteres'),
                new Id($item->id_client,false,'El id del cliente no tiene el formato valido'),
                new Numeric($item->id_status,false),
                new Id($item->id_user_created,true,'El id del usuario que registro no tiene el formato valido'),
                new DateTimeFormat($item->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
                new Id($item->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
            );
            $model->setUsuarioRegistro(new Text(is_null($item->userCreated) ? null  : ($item->userCreated->first_name . ' ' . $item->userCreated->last_name) ,true, 500 ,'El nombre del usuario que registro excede los 500 caracteres'));
            $model->setUsuarioModifico(new Text(is_null($item->userUpdated) ? null  : ($item->userUpdated->first_name . ' ' . $item->userUpdated->last_name) ,true, 500 ,'El nombre del usuario que modifico excede los 500 caracteres'));
            $model->setVehiculo(new Text(is_null($item->vehicle) ? null  : ($item->vehicle->plate) ,true, 50 ,'El nombre del vehiculo  excede los 50 caracteres'));
            $model->setPersonal(new Text(is_null($item->personal) ? null  : ($item->personal->firstname . ' ' . $item->personal->lastname) ,true, 250 ,'El nombre del personal  excede los 250 caracteres'));

            $collection[] = $model;
        }

        return $collection;
    }

}
