<?php

namespace Src\Administracion\MotivoAnulacion\Infraestructure\Repositories;

use App\Models\Administracion\MotivoAnulacion as EloquentMotivoAnulacion;
use Src\Administracion\MotivoAnulacion\Domain\ListMotivoAnulacion;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\MotivoAnulacion\Domain\Contracts\MotivoAnulacionRepositoryContract;
use Src\Administracion\MotivoAnulacion\Domain\MotivoAnulacion;

final class EloquentMotivoAnulacionRepository implements MotivoAnulacionRepositoryContract
{
    /**
     * @var EloquentMotivoAnulacion
     */
    private $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentMotivoAnulacion;
    }

    public function find(Id $id): ?MotivoAnulacion
    {
        $model = $this->eloquent->findOrFail($id->value());
        // Return Domain MotivoAnulacion model
        return new MotivoAnulacion(
            new Id($model->id,false,'El id del motivo no tiene el formato valido'),
            new Text($model->observation,false, 150,'El nombre del motivo excede los 150 caracteres'),
            new Id($model->id_client,true,'El id del usuario que registro no tiene el formato valido'),
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
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->create([
            'id' => $id->value(),
            'name' => $nombre->value(),
            'id_client' => $idCliente->value(),
            'id_status' => $idEstado->value(),
            'id_user_created' => $idUsuarioRegistro->value(),
            'id_user_updated' => $idUsuarioRegistro->value(),
        ]);

    }

    public function update(
        Id $id,
        Text $nombre,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
            'name' => $nombre->value(),
            'id_client' => $idCliente->value(),
            'id_status' => $idEstado->value(),
            'id_user_updated' => $idUsuarioRegistro->value(),
        ]);
    }

    public function collection(): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name')
            //->where('id_client',$idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new MotivoAnulacion(
                new Id($item->id,false,'El id del motivo no tiene el formato valido'),
                new Text($item->name,false, 150,'El nombre del motivo excede los 150 caracteres'),
                new Id($item->id_client,true,'El id del usuario que registro no tiene el formato valido'),
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

    public function list(): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name')
            //->where('id_client',$idCliente->value())
            ->where('id_status',1)
            ->get();

        foreach( $response as $item) {
            $model = new ListMotivoAnulacion(
                new Id($item->id,false,'El id del motivo no tiene el formato valido'),
                new Text($item->name,false, 150,'El nombre del motivo excede los 150 caracteres'),
                new Id($item->id_client,true,'El id del usuario que registro no tiene el formato valido'),
                new Numeric($item->id_status,false)
            );
            $collection[] = $model;
        }

        return $collection;
    }

}
