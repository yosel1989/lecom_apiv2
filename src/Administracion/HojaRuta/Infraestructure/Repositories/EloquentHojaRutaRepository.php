<?php

namespace Src\Administracion\HojaRuta\Infraestructure\Repositories;

use App\Models\Administracion\HojaRuta as EloquentHojaRuta;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\HojaRuta\Domain\Contracts\HojaRutaRepositoryContract;
use Src\Administracion\HojaRuta\Domain\HojaRuta;
use Src\ModelBase\Domain\ValueObjects\TimeFormat;

final class EloquentHojaRutaRepository implements HojaRutaRepositoryContract
{
    /**
     * @var EloquentHojaRuta
     */
    private $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentHojaRuta;
    }

    public function find(Id $id): ?HojaRuta
    {
        $model = $this->eloquent->findOrFail($id->value());
        // Return Domain HojaRuta model
        return new HojaRuta(
            new Id($model->id,false,'El id del HojaRuta no tiene el formato valido'),
            new Id($model->id_vehicle,false,'El id del vehiculo no tiene el formato valido'),
            new Id($model->id_personal,false,'El id del personal no tiene el formato valido'),
            new Id($model->id_route,false,'El id de la ruta no tiene el formato valido'),
            new DateOnlyFormat($model->date_assigned,true,'El formato de la fecha asignada es incorrecta'),
            new TimeFormat($model->time_assigned,true,'El formato de la hora asignada es incorrecta'),
            new Text($model->url_route_sheet,false, 500 ,'El url de la hoja de ruta tiene mas de 500 caracteres'),
            new Id($model->id_client,false,'El id del cliente que registro no tiene el formato valido'),
            new Numeric($model->id_status,false),
            new Id($model->id_user_creatd,true,'El id del usuario que registro no tiene el formato valido'),
            new DateTimeFormat($model->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
            new Id($model->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
            new DateTimeFormat($model->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
        );

    }

    public function create(
        Id $id,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idRuta,
        DateOnlyFormat $fechaAsignada,
        TimeFormat $horaAsignada,
        Text $urlHojaRuta,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->create([
            'id' => $id->value(),
            'id_vehicle' => $idVehiculo->value(),
            'id_personal' => $idPersonal->value(),
            'id_route' => $idRuta->value(),
            'date_assigned' => $fechaAsignada->value(),
            'time_assigned' => $horaAsignada->value(),
            'url_route_sheet' => $urlHojaRuta->value(),
            'id_status' => $idEstado->value(),
            'id_client' => $idCliente->value(),
            'id_user_created' => $idUsuarioRegistro->value()
        ]);

    }

    public function update(
        Id $id,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idRuta,
        DateOnlyFormat $fechaAsignada,
        TimeFormat $horaAsignada,
        Text $urlHojaRuta,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
            'id_vehicle' => $idVehiculo->value(),
            'id_personal' => $idPersonal->value(),
            'id_ruta' => $idRuta->value(),
            'date_assigned' => $fechaAsignada->value(),
            'time_assigned' => $horaAsignada->value(),
            'url_route_sheet' => $urlHojaRuta->value(),
            'id_status' => $idEstado->value(),
            'id_client' => $idCliente->value(),
            'id_user_updated' => $idUsuarioModifico->value()
        ]);
    }

    public function collectionByClient(Id $idCliente): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('ruta:id,name','userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name','vehicle:id,plate','personal:id,firstname,lastname')
            ->where('id_client',$idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new HojaRuta(
                new Id($item->id,false,'El id del HojaRuta no tiene el formato valido'),
                new Id($item->id_vehicle,false,'El id del vehiculo no tiene el formato valido'),
                new Id($item->id_personal,false,'El id del personal no tiene el formato valido'),
                new Id($item->id_route,false,'El id de la ruta no tiene el formato valido'),
                new DateOnlyFormat($item->date_assigned,true,'El formato de la fecha asignada es incorrecta'),
                new TimeFormat($item->time_assigned,true,'El formato de la hora asignada es incorrecta'),
                new Text($item->url_route_sheet,false, 500 ,'El url de la hoja de ruta tiene mas de 500 caracteres'),
                new Id($item->id_client,false,'El id del cliente que registro no tiene el formato valido'),
                new Numeric($item->id_status,false),
                new Id($item->id_user_created,true,'El id del usuario que registro no tiene el formato valido'),
                new DateTimeFormat($item->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
                new Id($item->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
            );
            $model->setFechaRegistro(new DateTimeFormat($item->created_at,true,'El formato de fecha de creación es incorrecta'));
            $model->setFechaModifico(new DateTimeFormat($item->updated_at,true,'El formato de fecha de modificación es incorrecta'));
            $model->setUsuarioRegistro(new Text(is_null($item->userCreated) ? null  : ($item->userCreated->first_name . ' ' . $item->userCreated->last_name) ,true, 500 ,'El nombre del usuario que registro excede los 500 caracteres'));
            $model->setUsuarioModifico(new Text(is_null($item->userUpdated) ? null  : ($item->userUpdated->first_name . ' ' . $item->userUpdated->last_name) ,true, 500 ,'El nombre del usuario que modifico excede los 500 caracteres'));
            $model->setPersonal(new Text(is_null($item->personal) ? null  : ($item->personal->firstname . ' ' . $item->personal->lastname),true, 500 ,'El nombre del personal excede los 500 caracteres'));
            $model->setPlaca(new Text(is_null($item->vehicle) ? null  : $item->vehicle->plate,true, 50 ,'La placa del vehiculo excede los 50 caracteres'));
            $model->setRuta(new Text(is_null($item->ruta) ? null  : $item->ruta->name,true, 150 ,'La ruta excede los 150 caracteres'));
            $collection[] = $model;
        }

        return $collection;
    }

    public function collectionByClientByDate(Id $idCliente, DateOnlyFormat $fechaAsignada): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('ruta:id,name','userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name','vehicle:id,plate','personal:id,firstname,lastname')
            ->where('id_client',$idCliente->value())
            ->whereDate('date_assigned',$fechaAsignada->value())
            ->get();

        foreach( $response as $item) {
            $model = new HojaRuta(
                new Id($item->id,false,'El id del HojaRuta no tiene el formato valido'),
                new Id($item->id_vehicle,false,'El id del vehiculo no tiene el formato valido'),
                new Id($item->id_personal,false,'El id del personal no tiene el formato valido'),
                new Id($item->id_route,false,'El id de la ruta no tiene el formato valido'),
                new DateOnlyFormat($item->date_assigned,false,'El formato de la fecha asignada es incorrecta'),
                new TimeFormat($item->time_assigned,true,'El formato de la hora asignada es incorrecta'),
                new Text($item->url_route_sheet,false, 500 ,'El url de la hoja de ruta tiene mas de 500 caracteres'),
                new Id($item->id_client,false,'El id del cliente que registro no tiene el formato valido'),
                new Numeric($item->id_status,false),
                new Id($item->id_user_created,true,'El id del usuario que registro no tiene el formato valido'),
                new DateTimeFormat($item->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
                new Id($item->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
            );
            $model->setFechaRegistro(new DateTimeFormat($item->created_at,true,'El formato de fecha de creación es incorrecta'));
            $model->setFechaModifico(new DateTimeFormat($item->updated_at,true,'El formato de fecha de modificación es incorrecta'));
            $model->setUsuarioRegistro(new Text(is_null($item->userCreated) ? null  : ($item->userCreated->first_name . ' ' . $item->userCreated->last_name) ,true, 500 ,'El nombre del usuario que registro excede los 500 caracteres'));
            $model->setUsuarioModifico(new Text(is_null($item->userUpdated) ? null  : ($item->userUpdated->first_name . ' ' . $item->userUpdated->last_name) ,true, 500 ,'El nombre del usuario que modifico excede los 500 caracteres'));
            $model->setPersonal(new Text(is_null($item->personal) ? null  : ($item->personal->firstname . ' ' . $item->personal->lastname),true, 500 ,'El nombre del personal excede los 500 caracteres'));
            $model->setPlaca(new Text(is_null($item->vehicle) ? null  : $item->vehicle->plate,true, 50 ,'La placa del vehiculo excede los 50 caracteres'));
            $model->setRuta(new Text(is_null($item->ruta) ? null  : $item->ruta->name,true, 150 ,'La ruta excede los 150 caracteres'));
            $collection[] = $model;
        }

        return $collection;
    }

}
