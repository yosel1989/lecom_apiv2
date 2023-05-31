<?php

namespace Src\Administracion\Ruta\Infraestructure\Repositories;

use App\Models\Administracion\Ruta as EloquentRutaModel;
use InvalidArgumentException;
use Src\Admin\User\Domain\User;
use Src\Administracion\Ruta\Domain\RutaShort;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Ruta\Domain\Contracts\RutaRepositoryContract;
use Src\Administracion\Ruta\Domain\Ruta;

final class EloquentRutaRepository implements RutaRepositoryContract
{
    /**
     * @var EloquentRutaModel
     */
    private $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentRutaModel;
    }

    public function find(Id $id): ?Ruta
    {
        $Ruta = $this->eloquent->findOrFail($id->value());
        // Return Domain Ruta model
        return new Ruta(
            new Id($Ruta->id,false,'El id del Ruta no tiene el formato valido'),
            new Text($Ruta->name,false, 150 ,'El nombre tiene mas de 150 caracteres'),
            new Text($Ruta->code,false, 15 ,'El codigo tiene mas de 15 caracteres'),
            new Numeric($Ruta->id_status,false),
            new Id($Ruta->id_user_created,false,'El id del usuario que registro no tiene el formato valido'),
            new Id($Ruta->id_client,false,'El id del cliente no tiene el formato valido'),
            new DateTimeFormat($Ruta->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
            new Id($Ruta->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
            new DateTimeFormat($Ruta->updated_at ,true, 'La fecha de modificación no tiene el formato correcto')
        );

    }

    public function create(
        Id $id,
        Text $nombre,
        Text $codigo,
        Numeric $idEstado,
        Id $idUsuarioRegistro,
        Id $idCliente
    ): void
    {
        $this->eloquent->create([
            'id' => $id->value(),
            'name' => $nombre->value(),
            'code' => $codigo->value(),
            'id_status' => $idEstado->value(),
            'id_user_created' => $idUsuarioRegistro->value(),
            'id_client' => $idCliente->value()
        ]);

    }

    public function update(
        Id $id,
        Text $nombre,
        Text $codigo,
        Numeric $idEstado,
        Id $idUsuarioModifico,
        Id $idCliente
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
            'id' => $id->value(),
            'name' => $nombre->value(),
            'code' => $codigo->value(),
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

        $response = $this->eloquent
            ->with('userCreated','userUpdated')
            ->where('id_client', $idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new Ruta(
                new Id($item->id,false,'El id del Ruta no tiene el formato valido'),
                new Text($item->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Text($item->code,false, 15 ,'El código tiene mas de 15 caracteres'),
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


    public function collectionActivedByClient(
        Id $idCliente
    ): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('userCreated','userUpdated')
            ->select(
                'id',
                'name',
                'code',
                'id_status',
                'id_client'
            )
            ->where('id_client', $idCliente->value())
            ->where('id_status', 1)
            ->get();

        foreach( $response as $item) {
            $model = new RutaShort(
                new Id($item->id,false,'El id del Ruta no tiene el formato valido'),
                new Text($item->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Text($item->code,false, 15 ,'El código tiene mas de 15 caracteres'),
                new Numeric($item->id_status,false)
            );
            $collection[] = $model;
        }

        return $collection;
    }

    public function findByClientByCode(
        Id $idCliente,
        Text $codigoRuta
    ): ?RutaShort
    {

        $route = $this->eloquent
            ->with('userCreated','userUpdated')
            ->select(
                'id',
                'name',
                'code',
                'id_status',
                'id_client'
            )
            ->where('id_client', $idCliente->value())
            ->where('code', $codigoRuta->value())
//            ->where('id_status', 1)
            ->first();

        if($route){
            if($route->id_status === 0){
                throw new InvalidArgumentException( "La ruta se encuentra inactiva" );
            }
            $model = new RutaShort(
                new Id($route->id,false,'El id del Ruta no tiene el formato valido'),
                new Text($route->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Text($route->code,false, 15 ,'El código tiene mas de 15 caracteres'),
                new Numeric($route->id_status,false)
            );
            return $model;
        }else{
            throw new InvalidArgumentException( "No se encontro la ruta {$route->code} en los registros del sistema" );
        }
    }
}
