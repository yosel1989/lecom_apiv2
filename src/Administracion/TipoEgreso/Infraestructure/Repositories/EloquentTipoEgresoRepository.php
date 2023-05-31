<?php

namespace Src\Administracion\TipoEgreso\Infraestructure\Repositories;

use App\Models\Administracion\TipoEgreso as EloquentTipoEgreso;
use Src\Administracion\TipoEgreso\Domain\TipoEgreso_S;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\TipoEgreso\Domain\Contracts\TipoEgresoRepositoryContract;
use Src\Administracion\TipoEgreso\Domain\TipoEgreso;

final class EloquentTipoEgresoRepository implements TipoEgresoRepositoryContract
{
    /**
     * @var EloquentTipoEgreso
     */
    private $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentTipoEgreso;
    }

    public function find(Id $id): ?TipoEgreso
    {
        $model = $this->eloquent->findOrFail($id->value());
        // Return Domain TipoEgreso model
        return new TipoEgreso(
            new Id($model->id,false,'El id del TipoEgreso no tiene el formato valido'),
            new Text($model->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
            new Text($model->description,true, 250 ,'La descripcion tiene mas de 250 caracteres'),
            new Numeric($model->has_vehicle,false),
            new Numeric($model->has_personal,false),
            new Numeric($model->has_route,false),
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
        Text $nombre,
        Text $descripcion,
        Numeric $registraVehiculo,
        Numeric $registraPersonal,
        Numeric $registraRuta,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->create([
            'id' => $id->value(),
            'name' => $nombre->value(),
            'description' => $descripcion->value(),
            'has_vehicle' => $registraVehiculo->value(),
            'has_personal' => $registraPersonal->value(),
            'has_route' => $registraRuta->value(),
            'id_status' => $idEstado->value(),
            'id_client' => $idCliente->value(),
            'id_user_created' => $idUsuarioRegistro->value()
        ]);

    }

    public function update(
        Id $id,
        Text $nombre,
        Text $descripcion,
        Numeric $registraVehiculo,
        Numeric $registraPersonal,
        Numeric $registraRuta,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
            'name' => $nombre->value(),
            'description' => $descripcion->value(),
            'has_vehicle' => $registraVehiculo->value(),
            'has_personal' => $registraPersonal->value(),
            'has_route' => $registraRuta->value(),
            'id_status' => $idEstado->value(),
            'id_client' => $idCliente->value(),
            'id_user_updated' => $idUsuarioModifico->value()
        ]);
    }

    public function collectionByClient(Id $idCliente): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name')
            ->where('id_client',$idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new TipoEgreso(
                new Id($item->id,false,'El id del TipoEgreso no tiene el formato valido'),
                new Text($item->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Text($item->description,true, 250 ,'La descripcion tiene mas de 250 caracteres'),
                new Numeric($item->has_vehicle,false),
                new Numeric($item->has_personal,false),
                new Numeric($item->has_route,false),
                new Id($item->id_client,false,'El id del cliente que registro no tiene el formato valido'),
                new Numeric($item->id_status,false),
                new Id($item->id_user_creatd,true,'El id del usuario que registro no tiene el formato valido'),
                new DateTimeFormat($item->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
                new Id($item->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
            );
            $model->setUsuarioRegistro(new Text(is_null($item->userCreated) ? null  : ($item->userCreated->first_name . ' ' . $item->userCreated->last_name) ,true, 500 ,'El nombre del usuario que registro excede los 500 caracteres'));
            $model->setUsuarioModifico(new Text(is_null($item->userUpdated) ? null  : ($item->userUpdated->first_name . ' ' . $item->userUpdated->last_name) ,true, 500 ,'El nombre del usuario que modifico excede los 500 caracteres'));
            $collection[] = $model;
        }

        return $collection;
    }


    public function listByClient(Id $idCliente): array
    {
        $collection = [];

        $response = $this->eloquent
            ->select(
                'id',
                'name',
                'has_personal',
                'has_route',
                'id_client',
                'id_status'
            )
            ->where('id_client',$idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new TipoEgreso_S(
                new Id($item->id,false,'El id del TipoEgreso no tiene el formato valido'),
                new Text($item->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Numeric($item->has_vehicle,false),
                new Numeric($item->has_personal,false),
                new Numeric($item->has_route,false),
                new Id($item->id_client,false,'El id del cliente que registro no tiene el formato valido'),
                new Numeric($item->id_status,false),
            );
            $collection[] = $model;
        }

        return $collection;
    }

}
