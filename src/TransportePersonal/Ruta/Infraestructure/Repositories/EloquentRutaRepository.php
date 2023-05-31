<?php


namespace Src\TransportePersonal\Ruta\Infraestructure\Repositories;


use App\Models\TransportePersonal\Ruta as EloquentRutaModel;
use App\Models\TransportePersonal\RutaParadero as EloquentRutaParaderoModel;
use App\Models\TransportePersonal\RutaVehiculo as EloquentRutaVehiculoModel;
use InvalidArgumentException;
use Src\Admin\User\Domain\User;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\Ruta\Domain\Contracts\RutaRepositoryContract;
use Src\TransportePersonal\Ruta\Domain\Ruta;
use Src\TransportePersonal\Ruta\Domain\RutaParadero;
use Src\TransportePersonal\Ruta\Domain\RutaVehiculo;


final class EloquentRutaRepository implements RutaRepositoryContract
{
    /**
     * @var EloquentRutaModel
     */
    private $eloquentRutaModel;
    private $eloquentRutaParaderoModel;
    private $eloquentRutaVehiculoModel;

    public function __construct()
    {
        $this->eloquentRutaModel = new EloquentRutaModel;
        $this->eloquentRutaParaderoModel = new EloquentRutaParaderoModel;
        $this->eloquentRutaVehiculoModel = new EloquentRutaVehiculoModel;
    }

    public function find(Id $id): ?Ruta
    {
        $Ruta = $this->eloquentRutaModel->findOrFail($id->value());
        // Return Domain Ruta model
        return new Ruta(
            new Id($Ruta->id,false,'El id del Ruta no tiene el formato valido'),
            new Text($Ruta->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
            new Numeric($Ruta->id_status,false),
            new Id($Ruta->id_user_created,false,'El id del usuario que registro no tiene el formato valido'),
            new Id($Ruta->id_client,false,'El id del cliente no tiene el formato valido'),
            new DateTimeFormat($Ruta->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
            new Id($Ruta->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
            new DateTimeFormat($Ruta->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
        );

    }

    public function create(
        Id $id,
        Text $nombre,
        Numeric $idEstado,
        Id $idUsuarioRegistro,
        Id $idCliente
    ): void
    {
        $this->eloquentRutaModel->create([
            'id' => $id->value(),
            'name' => $nombre->value(),
            'id_status' => $idEstado->value(),
            'id_user_created' => $idUsuarioRegistro->value(),
            'id_client' => $idCliente->value()
        ]);

    }

    public function update(
        Id $id,
        Text $nombre,
        Numeric $idEstado,
        Id $idUsuarioModifico,
        Id $idCliente
    ): void
    {
        $this->eloquentRutaModel->findOrFail($id->value())->update([
            'id' => $id->value(),
            'name' => $nombre->value(),
            'id_status' => $idEstado->value(),
            'id_user_updated' => $idUsuarioModifico->value(),
            'id_client' => $idCliente->value()
        ]);
    }
    public function collectionByClient(
        Id $idCliente
    ): array
    {
        $collection = [];

        $response = $this->eloquentRutaModel
            ->with('userCreated','userUpdated')
            ->where('id_client', $idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new Ruta(
                new Id($item->id,false,'El id del Ruta no tiene el formato valido'),
                new Text($item->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Numeric($item->id_status,false),
                new Id($item->id_user_created,false,'El id del usuario que registro no tiene el formato valido'),
                new Id($item->id_client,false,'El id del cliente no tiene el formato valido'),
                new DateTimeFormat($item->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
                new Id($item->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
            );
            $model->setFechaRegistro(new DateTimeFormat($item->created_at,true,'El formato de fecha de creación es incorrecta'));
            $model->setFechaModifico(new DateTimeFormat($item->updated_at,true,'El formato de fecha de modificación es incorrecta'));
            $userCreated = is_null($item->userCreated) ? null : User::createEntity($item->userCreated);
            $userUpdated = is_null($item->userUpdated) ? null : User::createEntity($item->userUpdated);
            $model->setUsuarioRegistro(new Text($userCreated ? $userCreated->getFirstName()->value() . ' ' . $userCreated->getLastName()->value() : '',true, 150 ,'El nombre del usuario que registro excede los 150 caracteres'));
            $model->setUsuarioModifico(new Text($userUpdated ? $userUpdated->getFirstName()->value() . ' ' . $userUpdated->getLastName()->value() : '',true, 150 ,'El nombre del usuario que modifico excede los 150 caracteres'));
            $collection[] = $model;
        }

        return $collection;
    }

    public function assignPoints(
        Id $idRuta,
        array $paraderos
    ): void
    {
        $collection = $this->eloquentRutaParaderoModel->where('id_ruta',$idRuta->value());
        $collection->delete();

        foreach ($paraderos as $paradero) {
            $this->eloquentRutaParaderoModel->create([
                'id_ruta' => $idRuta->value(),
                'id_tipo_ruta' => $paradero->getIdTipoRuta()->value(),
                'id_paradero' => $paradero->getIdParadero()->value(),
                'id_tipo_paradero' => $paradero->getIdTipo()->value()
            ]);
        }

    }

    public function listPoints(
        Id $idRuta
    ): array
    {
        $collection = [];

        $response = $this->eloquentRutaParaderoModel
            ->with('paradero:id,name','tipoRuta:id,name')
            ->where('id_ruta', $idRuta->value())
            ->get();

        foreach( $response as $item) {

            $model = new RutaParadero(
                new Id($item->id_tipo_ruta,false,'El id del Tipo de Ruta no tiene el formato valido'),
                new Id($item->id_paradero,false,'El id del Ruta no tiene el formato valido'),
                new Numeric($item->id_tipo_paradero,false),
            );
            $model->setParadero( is_null($item->paradero) ? new Text('',500, false) : new Text($item->paradero->name, false, 500,'Ocurrio un error') );
            $model->setTipoRuta( is_null($item->tipoRuta) ? new Text('',500, false) : new Text($item->tipoRuta->name, false, 500,'Ocurrio un error') );
            $collection[] = $model;
        }

        return $collection;
    }


    public function assignVehicles(
        Id $idRuta,
        array $vehiculos
    ): void
    {
        $collection = $this->eloquentRutaVehiculoModel->where('id_ruta',$idRuta->value());
        $collection->delete();

        foreach ($vehiculos as $vehiculo) {
            $this->eloquentRutaVehiculoModel->create([
                'id_ruta' => $idRuta->value(),
                'id_vehiculo' => $vehiculo->getIdVehiculo()->value(),
            ]);
        }

    }

    public function listVehicles(
        Id $idRuta
    ): array
    {
        $collection = [];

        $response = $this->eloquentRutaVehiculoModel
            ->with('vehiculo:id,plate','ruta:id,name')
            ->where('id_ruta', $idRuta->value())
            ->get();

        foreach( $response as $item) {

            $model = new RutaVehiculo(
                new Id($item->id_ruta,false,'El id del Tipo de Ruta no tiene el formato valido'),
                new Id($item->id_vehiculo,false,'El id del Ruta no tiene el formato valido')
            );
            $model->setVehiculo( is_null($item->vehiculo) ? new Text('',500, false) : new Text($item->vehiculo->plate, false, 500,'Ocurrio un error') );
            $model->setRuta( is_null($item->ruta) ? new Text('',500, false) : new Text($item->ruta->name, false, 500,'Ocurrio un error') );
            $collection[] = $model;
        }

        return $collection;
    }


    public function findVehicleByPlate(
        Text $placa
    ): ?RutaVehiculo
    {
        $collection = [];

        $response = $this->eloquentRutaVehiculoModel
            ->with('vehiculo:id,plate','ruta:id,name')
            ->whereHas('vehiculo', function ($query) use ($placa) {
                $query->where('plate', '=', $placa->value());
            })
            ->first();

        if(!$response){
            throw new InvalidArgumentException('El vehiculo no se encuentra registrado');
        }

        $model = new RutaVehiculo(
            new Id($response->id_ruta,false,'El id del Tipo de Ruta no tiene el formato valido'),
            new Id($response->id_vehiculo,false,'El id del Ruta no tiene el formato valido')
        );
        $model->setVehiculo( is_null($response->vehiculo) ? new Text('',500, false) : new Text($response->vehiculo->plate, false, 500,'Ocurrio un error') );
        $model->setRuta( is_null($response->ruta) ? new Text('',500, false) : new Text($response->ruta->name, false, 500,'Ocurrio un error') );

        return $model;
    }
}
