<?php


namespace Src\Administracion\PersonalCategoria\Infraestructure\Repositories;


use App\Models\Administracion\PersonalCategoria as EloquentPersonalCategoria;
use Src\Admin\User\Domain\User;
use Src\Administracion\PersonalCategoria\Domain\PersonalCategoriaShort;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\PersonalCategoria\Domain\Contracts\PersonalCategoriaRepositoryContract;
use Src\Administracion\PersonalCategoria\Domain\PersonalCategoria;

final class EloquentPersonalCategoriaRepository implements PersonalCategoriaRepositoryContract
{
    /**
     * @var EloquentPersonalCategoria
     */
    private $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentPersonalCategoria;
    }

    public function find(Id $id): ?PersonalCategoria
    {
        $model = $this->eloquent->findOrFail($id->value());
        // Return Domain PersonalCategoria model
        return new PersonalCategoria(
            new Id($model->id,false,'El id del PersonalCategoria no tiene el formato valido'),
            new Text($model->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
            new Numeric($model->code,false),
            new Numeric($model->id_status,false),
            new Id($model->id_user_created,false,'El id del usuario que registro no tiene el formato valido'),
            new DateTimeFormat($model->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
            new Id($model->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
            new DateTimeFormat($model->updated_at ,true, 'La fecha de modificación no tiene el formato correcto'),
        );

    }

    public function create(
        Id $id,
        Text $nombre,
        Numeric $codigo,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->create([
            'id' => $id->value(),
            'name' => $nombre->value(),
            'code' => $codigo->value(),
            'id_status' => $idEstado->value(),
            'id_user_created' => $idUsuarioRegistro->value()
        ]);

    }

    public function update(
        Id $id,
        Text $nombre,
        Numeric $codigo,
        Numeric $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
            'name' => $nombre->value(),
            'code' => $codigo->value(),
            'id_status' => $idEstado->value(),
            'id_user_updated' => $idUsuarioModifico->value()
        ]);
    }

    public function collection(): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('userCreated','userUpdated')
            ->get();

        foreach( $response as $item) {
            $model = new PersonalCategoria(
                new Id($item->id,false,'El id del personal categoria no tiene el formato valido'),
                new Text($item->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Numeric($item->code,false),
                new Numeric($item->id_status,false),
                new Id($item->id_user_created,false,'El id del usuario que registro no tiene el formato valido'),
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

    public function collectionActived(): array
    {
        $collection = [];

        $response = $this->eloquent
            ->select(
                'id',
                'name',
                'code',
                'id_status'
            )
            ->where('id_status',1)
            ->get();

        foreach( $response as $item) {
            $model = new PersonalCategoriaShort(
                new Id($item->id,false,'El id del personal categoria no tiene el formato valido'),
                new Text($item->name,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Numeric($item->code,false),
                new Numeric($item->id_status,false),
            );
            $collection[] = $model;
        }

        return $collection;
    }
}
