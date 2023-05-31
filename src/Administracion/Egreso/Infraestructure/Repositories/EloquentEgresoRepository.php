<?php

namespace Src\Administracion\Egreso\Infraestructure\Repositories;

use App\Models\Administracion\Egreso as EloquentEgreso;
use Illuminate\Support\Facades\DB;
use Src\Administracion\Egreso\Domain\LiquidacionDiaria;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Egreso\Domain\Contracts\EgresoRepositoryContract;
use Src\Administracion\Egreso\Domain\Egreso;

final class EloquentEgresoRepository implements EgresoRepositoryContract
{
    /**
     * @var EloquentEgreso
     */
    private $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentEgreso;
    }

    public function find(Id $id): ?Egreso
    {
        $model = $this->eloquent->findOrFail($id->value());
        // Return Domain Egreso model
        return new Egreso(
            new Id($model->id,false,'El id del Egreso no tiene el formato valido'),
            new DateOnlyFormat($model->date,false,'La fecha tiene un formato invalido'),
            new Id($model->id_tipo_egreso,false,'El id del tipo de Egreso no tiene el formato valido'),
            new Id($model->id_vehicle,true,'El id del vehiculo no tiene el formato valido'),
            new Id($model->id_personal,true,'El id del personal no tiene el formato valido'),
            new Id($model->id_route,true,'El id de la ruta no tiene el formato valido'),
            new Numeric($model->amount,false),
            new Text($model->observation,true, 250,'La observación excede los 250 caracteres'),
            new Id($model->id_client,false,'El id del usuario que registro no tiene el formato valido'),
            new Numeric($model->id_status,false),
            new Id($model->id_user_creatd,true,'El id del usuario que registro no tiene el formato valido'),
            new DateTimeFormat($model->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
            new Id($model->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
            new DateTimeFormat($model->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
        );

    }

    public function create(
        Id $id,
        DateOnlyFormat $fecha,
        Id $idTipoEgreso,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idRuta,
        Numeric $monto,
        Text $observacion,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->create([
            'id' => $id->value(),
            'date' => $fecha->value(),
            'id_tipo_egreso' => $idTipoEgreso->value(),
            'id_vehicle' => $idVehiculo->value(),
            'id_personal' => $idPersonal->value(),
            'id_route' => $idRuta->value(),
            'amount' => $monto->value(),
            'observation' => $observacion->value(),
            'id_client' => $idCliente->value(),
            'id_status' => $idEstado->value(),
            'id_user_created' => $idUsuarioRegistro->value()
        ]);

    }

    public function update(
        Id $id,
        DateOnlyFormat $fecha,
        Id $idTipoEgreso,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idRuta,
        Numeric $monto,
        Text $observacion,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
            'date' => $fecha->value(),
            'id_tipo_egreso' => $idTipoEgreso->value(),
            'id_vehicle' => $idVehiculo->value(),
            'id_personal' => $idPersonal->value(),
            'id_route' => $idRuta->value(),
            'amount' => $monto->value(),
            'observation' => $observacion->value(),
            'id_client' => $idCliente->value(),
            'id_status' => $idEstado->value(),
            'id_user_updated' => $idUsuarioRegistro->value()
        ]);
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
            ->with('userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name', 'tipoEgreso:id,name','vehicle:id,plate','route:id,name','personal:id,firstname,lastname')
            ->where('id_client',$idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new Egreso(
                new Id($item->id,false,'El id del Egreso no tiene el formato valido'),
                new DateOnlyFormat($item->date,false,'La fecha tiene un formato invalido'),
                new Id($item->id_tipo_egreso,false,'El id del tipo de Egreso no tiene el formato valido'),
                new Id($item->id_vehicle,true,'El id del vehiculo no tiene el formato valido'),
                new Id($item->id_personal,true,'El id del personal no tiene el formato valido'),
                new Id($item->id_route,true,'El id de la ruta no tiene el formato valido'),
                new Numeric($item->amount,false),
                new Text($item->observation,true, 250,'La observación excede los 250 caracteres'),
                new Id($item->id_client,false,'El id del usuario que registro no tiene el formato valido'),
                new Numeric($item->id_status,false),
                new Id($item->id_user_creatd,true,'El id del usuario que registro no tiene el formato valido'),
                new DateTimeFormat($item->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
                new Id($item->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
            );
            $model->setUsuarioRegistro(new Text(is_null($item->userCreated) ? null  : ($item->userCreated->first_name . ' ' . $item->userCreated->last_name) ,true, 500 ,'El nombre del usuario que registro excede los 500 caracteres'));
            $model->setUsuarioModifico(new Text(is_null($item->userUpdated) ? null  : ($item->userUpdated->first_name . ' ' . $item->userUpdated->last_name) ,true, 500 ,'El nombre del usuario que modifico excede los 500 caracteres'));
            $model->setVehiculo(new Text(is_null($item->vehicle) ? null  : ($item->vehicle->plate) ,true, 50 ,'El nombre del vehiculo  excede los 50 caracteres'));
            $model->setPersonal(new Text(is_null($item->personal) ? null  : ($item->personal->firstname . ' ' . $item->personal->lastname) ,true, 250 ,'El nombre del personal  excede los 250 caracteres'));
            $model->setRuta(new Text(is_null($item->route) ? null  : ($item->route->name) ,true, 250 ,'El nombre de la ruta  excede los 250 caracteres'));
            $model->setTipoEgreso(new Text(is_null($item->tipoEgreso) ? null  : ($item->tipoEgreso->name) ,true, 100 ,'El nombre del tipo de Egreso  excede los 100 caracteres'));
            $collection[] = $model;
        }

        return $collection;
    }

    public function collectionByClientByDate(Id $idCliente, DateOnlyFormat $fecha): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name','tipoEgreso:id,name','vehicle:id,plate','route:id,name','personal:id,firstname,lastname')
            ->where('id_client',$idCliente->value())
            ->whereDate('date', $fecha->value())
            ->get();

        foreach( $response as $item) {
            $model = new Egreso(
                new Id($item->id,false,'El id del Egreso no tiene el formato valido'),
                new DateOnlyFormat($item->date,false,'La fecha tiene un formato invalido'),
                new Id($item->id_tipo_egreso,false,'El id del tipo de Egreso no tiene el formato valido'),
                new Id($item->id_vehicle,true,'El id del vehiculo no tiene el formato valido'),
                new Id($item->id_personal,true,'El id del personal no tiene el formato valido'),
                new Id($item->id_route,true,'El id de la ruta no tiene el formato valido'),
                new Numeric($item->amount,false),
                new Text($item->observation,true, 250,'La observación excede los 250 caracteres'),
                new Id($item->id_client,false,'El id del usuario que registro no tiene el formato valido'),
                new Numeric($item->id_status,false),
                new Id($item->id_user_creatd,true,'El id del usuario que registro no tiene el formato valido'),
                new DateTimeFormat($item->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
                new Id($item->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
            );
            $model->setUsuarioRegistro(new Text(is_null($item->userCreated) ? null  : ($item->userCreated->first_name . ' ' . $item->userCreated->last_name) ,true, 500 ,'El nombre del usuario que registro excede los 500 caracteres'));
            $model->setUsuarioModifico(new Text(is_null($item->userUpdated) ? null  : ($item->userUpdated->first_name . ' ' . $item->userUpdated->last_name) ,true, 500 ,'El nombre del usuario que modifico excede los 500 caracteres'));
            $model->setVehiculo(new Text(is_null($item->vehicle) ? null  : ($item->vehicle->plate) ,true, 50 ,'El nombre del vehiculo  excede los 50 caracteres'));
            $model->setPersonal(new Text(is_null($item->personal) ? null  : ($item->personal->firstname . ' ' . $item->personal->lastname) ,true, 250 ,'El nombre del personal  excede los 250 caracteres'));
            $model->setRuta(new Text(is_null($item->route) ? null  : ($item->route->name) ,true, 250 ,'El nombre de la ruta  excede los 250 caracteres'));
            $model->setTipoEgreso(new Text(is_null($item->tipoEgreso) ? null  : ($item->tipoEgreso->name) ,true, 100 ,'El nombre del tipo de Egreso  excede los 100 caracteres'));

            $collection[] = $model;
        }

        return $collection;
    }

    public function report(DateOnlyFormat $fechaDesde, DateOnlyFormat $fechaHasta, Id $idVehiculo, Id $idCliente): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name','tipoEgreso:id,name','vehicle:id,plate','route:id,name','personal:id,firstname,lastname')
            ->where('id_client',$idCliente->value())
            ->where('id_vehicle',$idVehiculo)
            ->whereDate('date','>=', $fechaDesde->value())
            ->whereDate('date','<=', $fechaHasta->value())
            ->get();

        foreach( $response as $item) {
            $model = new Egreso(
                new Id($item->id,false,'El id del Egreso no tiene el formato valido'),
                new DateOnlyFormat($item->date,false,'La fecha tiene un formato invalido'),
                new Id($item->id_tipo_egreso,false,'El id del tipo de Egreso no tiene el formato valido'),
                new Id($item->id_vehicle,true,'El id del vehiculo no tiene el formato valido'),
                new Id($item->id_personal,true,'El id del personal no tiene el formato valido'),
                new Id($item->id_route,true,'El id de la ruta no tiene el formato valido'),
                new Numeric($item->amount,false),
                new Text($item->observation,true, 250,'La observación excede los 250 caracteres'),
                new Id($item->id_client,false,'El id del usuario que registro no tiene el formato valido'),
                new Numeric($item->id_status,false),
                new Id($item->id_user_creatd,true,'El id del usuario que registro no tiene el formato valido'),
                new DateTimeFormat($item->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
                new Id($item->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
            );
            $model->setUsuarioRegistro(new Text(is_null($item->userCreated) ? null  : ($item->userCreated->first_name . ' ' . $item->userCreated->last_name) ,true, 500 ,'El nombre del usuario que registro excede los 500 caracteres'));
            $model->setUsuarioModifico(new Text(is_null($item->userUpdated) ? null  : ($item->userUpdated->first_name . ' ' . $item->userUpdated->last_name) ,true, 500 ,'El nombre del usuario que modifico excede los 500 caracteres'));
            $model->setVehiculo(new Text(is_null($item->vehicle) ? null  : ($item->vehicle->plate) ,true, 50 ,'El nombre del vehiculo  excede los 50 caracteres'));
            $model->setPersonal(new Text(is_null($item->personal) ? null  : ($item->personal->firstname . ' ' . $item->personal->lastname) ,true, 250 ,'El nombre del personal  excede los 250 caracteres'));
            $model->setRuta(new Text(is_null($item->route) ? null  : ($item->route->name) ,true, 250 ,'El nombre de la ruta  excede los 250 caracteres'));
            $model->setTipoEgreso(new Text(is_null($item->tipoEgreso) ? null  : ($item->tipoEgreso->name) ,true, 100 ,'El nombre del tipo de Egreso  excede los 100 caracteres'));

            $collection[] = $model;
        }

        return $collection;
    }

    public function liquidacionDiariaBus(DateOnlyFormat $fecha, Id $idCliente, Id $idVehiculo): array
    {
        $collection = [];

        $response = DB::select('call Adm_Interprov_EgresoLiquidacionDiariaBus(?,?,?)',array($idCliente->value(),$fecha->value(),$idVehiculo->value()));

        foreach( $response as $item) {
            $model = new LiquidacionDiaria(
                new Id($item->IdTipoEgreso,false,'El id del tipo de egreso no tiene el formato valido'),
                new Text($item->TipoEgreso,true, 75,'El texto de la liquidación los 75 caracteres'),
                new Numeric((float)$item->Total,false),
            );
            $collection[] = $model;
        }

        return $collection;
    }

}
