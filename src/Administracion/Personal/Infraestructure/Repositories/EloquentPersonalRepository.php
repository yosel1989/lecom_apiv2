<?php


namespace Src\Administracion\Personal\Infraestructure\Repositories;


use App\Models\Administracion\Personal as EloquentPersonal;
use Src\Admin\User\Domain\User;
use Src\Administracion\Personal\Domain\PersonalShort;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Personal\Domain\Contracts\PersonalRepositoryContract;
use Src\Administracion\Personal\Domain\Personal;

final class EloquentPersonalRepository implements PersonalRepositoryContract
{
    /**
     * @var EloquentPersonal
     */
    private $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentPersonal;
    }

    public function find(Id $id): ?Personal
    {
        $model = $this->eloquent->findOrFail($id->value());
        // Return Domain Personal model
        return new Personal(
            new Id($model->id,false,'El id del Personal no tiene el formato valido'),
            new Text($model->firstname,false, 100 ,'El nombre tiene mas de 100 caracteres'),
            new Text($model->lastname,false, 100 ,'El apellido tiene mas de 100 caracteres'),
            new Text($model->personal_document,true, 20 ,'El documento de identidad tiene mas de 20 caracteres'),
            new DateOnlyFormat($model->birth_date,true,'El formato de la fecha de nacimiento es incorrecta'),
            new Id($model->id_personal_category,false,'El id de la categoria de personal que registro no tiene el formato valido'),
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
        Text $apellido,
        Text $documentoIdentidad,
        DateOnlyFormat $fechaNacimiento,
        Id $idCategoriaPersonal,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->create([
            'id' => $id->value(),
            'firstname' => $nombre->value(),
            'lastname' => $apellido->value(),
            'personal_document' => $documentoIdentidad->value(),
            'birth_date' => $fechaNacimiento->value(),
            'id_status' => $idEstado->value(),
            'id_personal_category' => $idCategoriaPersonal->value(),
            'id_client' => $idCliente->value(),
            'id_user_created' => $idUsuarioRegistro->value()
        ]);

    }

    public function update(
        Id $id,
        Text $nombre,
        Text $apellido,
        Text $documentoIdentidad,
        DateOnlyFormat $fechaNacimiento,
        Id $idCategoriaPersonal,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
            'firstname' => $nombre->value(),
            'lastname' => $apellido->value(),
            'personal_document' => $documentoIdentidad->value(),
            'birth_date' => $fechaNacimiento->value(),
            'id_status' => $idEstado->value(),
            'id_personal_category' => $idCategoriaPersonal->value(),
            'id_client' => $idCliente->value(),
            'id_user_created' => $idUsuarioRegistro->value()
        ]);
    }

    public function collectionByClient(Id $idCliente): array
    {
        $collection = [];

        $response = $this->eloquent
            ->with('userCreated','userUpdated','category:id,name')
            ->where('id_client',$idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new Personal(
                new Id($item->id,false,'El id del Personal no tiene el formato valido'),
                new Text($item->firstname,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Text($item->lastname,false, 100 ,'El apellido tiene mas de 100 caracteres'),
                new Text($item->personal_document,true, 20 ,'El documento de identidad tiene mas de 20 caracteres'),
                new DateOnlyFormat($item->birth_date,true,'El formato de la fecha de nacimiento es incorrecta'),
                new Id($item->id_personal_category,false,'El id de la categoria de personal que registro no tiene el formato valido'),
                new Id($item->id_client,false,'El id del cliente que registro no tiene el formato valido'),
                new Numeric($item->id_status,false),
                new Id($item->id_user_created,true,'El id del usuario que registro no tiene el formato valido'),
                new DateTimeFormat($item->created_at ,false, 'La fecha de creación no tiene el formato correcto'),
                new Id($item->id_user_updated,true,'El id del usuario que modifico no tiene el formato valido'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de modificación no tiene el formato correcto')
            );
            $model->setFechaRegistro(new DateTimeFormat($item->created_at,true,'El formato de fecha de creación es incorrecta'));
            $model->setFechaModifico(new DateTimeFormat($item->updated_at,true,'El formato de fecha de modificación es incorrecta'));
            $userCreated = is_null($item->userCreated) ? null : User::createEntity($item->userCreated);
            $userUpdated = is_null($item->userUpdated) ? null : User::createEntity($item->userUpdated);
            $model->setUsuarioRegistro(new Text($userCreated ? $userCreated->getFirstName()->value() . ' ' . $userCreated->getLastName()->value() : '',true, 150 ,'El nombre del usuario que registro excede los 150 caracteres'));
            $model->setUsuarioModifico(new Text($userUpdated ? $userUpdated->getFirstName()->value() . ' ' . $userUpdated->getLastName()->value() : '',true, 150 ,'El nombre del usuario que modifico excede los 150 caracteres'));
            $model->setCategoria(new Text(is_null($item->category) ? null  : $item->category->name,true, 100 ,'El nombre de la categoria excede los 100 caracteres'));
            $collection[] = $model;
        }

        return $collection;
    }

    public function collectionByClientByCategory(Id $idCliente, Numeric $codeCategory): array
    {
        $collection = [];

        $response = $this->eloquent
            ->select(
                'id',
                'firstname',
                'lastname',
                'id_client',
                'id_status',
                'id_personal_category',
            )
            ->whereHas('category' , function($q) use($codeCategory){
                if($codeCategory->value() !== 0 ){
                    $q->where('code','=', $codeCategory->value());
                }
            })
            ->where('id_status',1)
            ->where('id_client',$idCliente->value())
            ->get();

        foreach( $response as $item) {
            $model = new PersonalShort(
                new Id($item->id,false,'El id del Personal no tiene el formato valido'),
                new Text($item->firstname,false, 100 ,'El nombre tiene mas de 100 caracteres'),
                new Text($item->lastname,false, 100 ,'El apellido tiene mas de 100 caracteres'),
                new Id($item->id_client,false,'El id del cliente que registro no tiene el formato valido'),
                new Numeric($item->id_status,false)
            );
            $collection[] = $model;
        }

        return $collection;
    }
}
