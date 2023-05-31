<?php


namespace Src\TransportePersonal\Troncal\Infraestructure\Repositories;


use App\Models\TransportePersonal\Troncal as EloquentTroncalModel;
use App\Models\TransportePersonal\TroncalParadero as EloquentTroncalParaderoModel;
use Src\Admin\User\Domain\User;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\Troncal\Domain\Contracts\TroncalRepositoryContract;
use Src\TransportePersonal\Troncal\Domain\Troncal;
use Src\TransportePersonal\Troncal\Domain\TroncalParadero;

final class EloquentTroncalRepository implements TroncalRepositoryContract
{
    /**
     * @var EloquentTroncalModel
     */
    private $eloquentTroncalModel;

    private $eloquentTroncalParaderoModel;

    public function __construct()
    {
        $this->eloquentTroncalModel = new EloquentTroncalModel;
        $this->eloquentTroncalParaderoModel = new EloquentTroncalParaderoModel;
    }

    public function find(Id $id): ?Troncal
    {
        $Troncal = $this->eloquentTroncalModel->findOrFail($id->value());
        // Return Domain Troncal model
        return new Troncal(
            new Id($Troncal->id,false,'El id del Troncal no tiene el formato valido'),
            new Text($Troncal->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
            new Numeric($Troncal->id_status,false),
            new Id($Troncal->id_user_created,false,'El id del usuario que registro no tiene el formato valido'),
            new Id($Troncal->id_client,false,'El id del cliente no tiene el formato valido'),
            new DateTimeFormat($Troncal->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
            new Id($Troncal->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
            new DateTimeFormat($Troncal->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
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
        $this->eloquentTroncalModel->create([
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
        $this->eloquentTroncalModel->findOrFail($id->value())->update([
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

        $response = $this->eloquentTroncalModel
            ->with('userCreated','userUpdated')
            ->where('id_client', $idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new Troncal(
                new Id($item->id,false,'El id del Troncal no tiene el formato valido'),
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
        $collection = $this->eloquentTroncalParaderoModel->where('id_tipo_ruta',$idRuta->value());
        $collection->delete();

        foreach ($paraderos as $paradero) {
            $this->eloquentTroncalParaderoModel->create([
               'id_tipo_ruta' => $idRuta->value(),
               'id_paradero' => $paradero->getIdParadero()->value(),
               'id_tipo_paradero' => $paradero->getIdTipo()->value()
            ]);
        }

    }

    public function listPoints(
        Id $idTroncal
    ): array
    {
        $collection = [];

        $response = $this->eloquentTroncalParaderoModel
            ->with('paradero:id,name')
            ->where('id_tipo_ruta', $idTroncal->value())
            ->get();

        foreach( $response as $item) {

            $model = new TroncalParadero(
                new Id($item->id_paradero,false,'El id del Troncal no tiene el formato valido'),
                new Numeric($item->id_tipo_paradero,false),
            );
            $model->setParadero( is_null($item->paradero) ? new Text('',500, false) : new Text($item->paradero->name, false, 500,'Ocurrio un error') );
            $collection[] = $model;
        }

        return $collection;
    }
}
