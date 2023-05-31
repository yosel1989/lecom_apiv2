<?php


namespace Src\TransportePersonal\Paradero\Infraestructure\Repositories;


use App\Models\TransportePersonal\Paradero as EloquentParaderoModel;
use App\Models\TransportePersonal\ParaderoHora as EloquentParaderoHoraModel;
use Src\Admin\User\Domain\User;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\ModelBase\Domain\ValueObjects\TimeFormat;
use Src\TransportePersonal\Paradero\Domain\Contracts\ParaderoRepositoryContract;
use Src\TransportePersonal\Paradero\Domain\ListParadero;
use Src\TransportePersonal\Paradero\Domain\Paradero;
use Src\TransportePersonal\Paradero\Domain\ParaderoHora;

final class EloquentParaderoRepository implements ParaderoRepositoryContract
{
    /**
     * @var EloquentParaderoModel
     */
    private $eloquentParaderoModel;
    private $eloquentParaderoHoraModel;

    public function __construct()
    {
        $this->eloquentParaderoModel = new EloquentParaderoModel;
        $this->eloquentParaderoHoraModel = new EloquentParaderoHoraModel;
    }

    public function find(Id $id): ?Paradero
    {
        $Paradero = $this->eloquentParaderoModel->findOrFail($id->value());
        // Return Domain Paradero model
        return new Paradero(
            new Id($Paradero->id,false,'El id del paradero no tiene el formato valido'),
            new Text($Paradero->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
            new Text($Paradero->short_name,true, 50 ,'El nombre corto tiene mas de 50 caracteres'),
            new Numeric($Paradero->id_status,false),
            new Id($Paradero->id_user_created,false,'El id del usuario que registro no tiene el formato valido'),
            new Id($Paradero->id_client,false,'El id del cliente no tiene el formato valido'),
            new DateTimeFormat($Paradero->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
            new Id($Paradero->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
            new DateTimeFormat($Paradero->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
        );

    }

    public function create(
        Id $id,
        Text $nombre,
        Text $nombreCorto,
        Numeric $idEstado,
        Id $idUsuarioRegistro,
        Id $idCliente
    ): void
    {
        $this->eloquentParaderoModel->create([
            'id' => $id->value(),
            'name' => $nombre->value(),
            'short_name' => $nombreCorto->value(),
            'id_status' => $idEstado->value(),
            'id_user_created' => $idUsuarioRegistro->value(),
            'id_client' => $idCliente->value()
        ]);
    }

    public function update(
        Id $id,
        Text $nombre,
        Text $nombreCorto,
        Numeric $idEstado,
        Id $idUsuarioModifico,
        Id $idCliente
    ): void
    {
        $this->eloquentParaderoModel->findOrFail($id->value())->update([
            'id' => $id->value(),
            'name' => $nombre->value(),
            'short_name' => $nombreCorto->value(),
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

        $response = $this->eloquentParaderoModel
            ->with('userCreated','userUpdated')
            ->where('id_client', $idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new Paradero(
                new Id($item->id,false,'El id del paradero no tiene el formato valido'),
                new Text($item->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Text($item->short_name,true, 50 ,'El nombre corto tiene mas de 50 caracteres'),
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


    public function listByClient(
        Id $idCliente
    ): array
    {
        $collection = [];

        $response = $this->eloquentParaderoModel
            ->select(
                'id',
                'name'
            )
            ->with('userCreated','userUpdated')
            ->where('id_client', $idCliente->value())
            ->where('id_status', 1)
            ->get();

        foreach( $response as $item) {
            $model = new ListParadero(
                new Id($item->id,false,'El id del paradero no tiene el formato valido'),
                new Text($item->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
            );
            $collection[] = $model;
        }

        return $collection;
    }

    public function assignHours(
        Id $idParadero,
        array $horas
    ): void
    {
        $collection = $this->eloquentParaderoHoraModel->where('id_paradero',$idParadero->value());
        $collection->delete();

        foreach ($horas as $hora) {
            $this->eloquentParaderoHoraModel->create([
                'id_paradero' => $idParadero->value(),
                'id_ruta' => $hora->getIdRuta()->value(),
                'id_tipo_ruta' => $hora->getIdTipoRuta()->value(),
                'id_tipo_paradero' => $hora->getIdTipoParadero()->value(),
                'hora' => $hora->getHora()->value(),
            ]);
        }

    }

    public function listHours(
        Id $idParadero
    ): array
    {
        $collection = [];

        $response = $this->eloquentParaderoHoraModel
            ->with('ruta:id,name','tipoRuta:id,name')
            ->where('id_paradero', $idParadero->value())
            ->get();

        foreach( $response as $item) {

            $model = new ParaderoHora(
                new Id($item->id_ruta,false,'El id de la ruta no tiene el formato valido'),
                new Id($item->id_tipo_ruta,false,'El id del tipo de ruta no tiene el formato valido'),
                new Numeric($item->id_tipo_paradero,false),
                new TimeFormat($item->hora,false)
            );
            $model->setRuta( is_null($item->ruta) ? new Text('',500, false) : new Text($item->ruta->name, false, 500,'Ocurrio un error') );
            $model->setTipoRuta( is_null($item->tipoRuta) ? new Text('',500, false) : new Text($item->tipoRuta->name, false, 500,'Ocurrio un error') );
            $collection[] = $model;
        }

        return $collection;
    }

    public function listHoursByRoute(
        Id $idRuta
    ): array
    {
        $collection = [];

        $response = $this->eloquentParaderoHoraModel
            ->where('id_ruta', $idRuta->value())
            ->groupBy('hora')
            ->get();

        foreach( $response as $item) {

            $model = new ParaderoHora(
                new Id($item->id_ruta,false,'El id de la ruta no tiene el formato valido'),
                new Id($item->id_tipo_ruta,false,'El id del tipo de ruta no tiene el formato valido'),
                new Numeric($item->id_tipo_paradero,false),
                new TimeFormat($item->hora,false)
            );

            $collection[] = $model;
        }

        return $collection;
    }


}
