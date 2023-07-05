<?php


namespace Src\Admin\User\Infraestructure\Repositories;


use App\Models\User as EloquentUserModel;
use App\Models\Admin\UserVehicle as EloquentUserVehicleModel;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Module\Domain\Module;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Domain\Contracts\UserRepositoryContract;
use Src\Admin\User\Domain\ValueObjects\UserActived;
use Src\Admin\User\Domain\ValueObjects\UserDeleted;
use Src\Admin\User\Domain\ValueObjects\UserEmail;
use Src\Admin\User\Domain\ValueObjects\UserFirstName;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Admin\User\Domain\ValueObjects\UserIdClient;
use Src\Admin\User\Domain\ValueObjects\UserIdRole;
use Src\Admin\User\Domain\ValueObjects\UserLastName;
use Src\Admin\User\Domain\ValueObjects\UserLevel;
use Src\Admin\User\Domain\ValueObjects\UserPassword;
use Src\Admin\User\Domain\ValueObjects\UserPhone;
use Src\Admin\User\Domain\ValueObjects\UserUserName;
use Src\Admin\Vehicle\Domain\SmallVehicle;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;
use Src\Admin\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleUnit;


final class EloquentUserRepository implements UserRepositoryContract
{
    /**
     * @var EloquentUserModel
     */
    private $eloquentUserModel;
    private $eloquentUserVehicleModel;

    public function __construct()
    {
        $this->eloquentUserModel = new EloquentUserModel;
        $this->eloquentUserVehicleModel = new EloquentUserVehicleModel;
    }

    public function create(
        UserId $id,
        UserUserName $username,
        UserFirstName $firstName,
        UserLastName $lastName,
        UserPassword $password,
        UserEmail $email,
        UserPhone $phone,
        UserLevel $level,
        UserActived $actived,
        UserIdClient $idClient,
        UserIdRole $idRole
    ): ?User
    {
        $this->eloquentUserModel->create([
            'id'=>$id->value(),
            'usuario'=>$username->value(),
            'clave'=> $password->value(),
            'nombres'=>$firstName->value(),
            'apellidos'=>$lastName->value(),
            'correo'=>$email->value(),
            'telefono'=>$phone->value(),
            'idNivel'=>$level->value(),
            'idEstado'=>$actived->value(),
            'idEliminado'=>0,
            'idCliente'=>$idClient->value(),
            'idRol'=>$idRole->value()
        ]);

        $OUser = $this->eloquentUserModel->with('modulos')->findOrFail($id->value());

        $user = new User(
            new UserId( $OUser->id ),
            new UserUserName( $OUser->usuario ),
            new UserFirstName( $OUser->nombres ),
            new UserLastName( $OUser->apellidos ),
            new UserEmail( $OUser->correo ),
            new UserPhone( $OUser->telefono ),
            new UserLevel( $OUser->idNivel ),
            new UserActived( $OUser->idEstado ),
            new UserDeleted( $OUser->idEliminado ),
            new UserIdClient( $OUser->idCliente ),
            new UserIdRole( $OUser->idRol )
        );

        $modulos = is_null($OUser->modulos) ? null : $OUser->modulos;
        $arrModulos = [];

        if( $modulos ){
            foreach ( $modulos as $modulo ){
                $arrModulos[] = Module::createEntity($modulo);
            }
        }

        $user->setModules($arrModulos);

        return $user;
    }

    public function update(
        UserId $id,
        UserFirstName $firstName,
        UserLastName $lastName,
        UserEmail $email,
        UserPhone $phone,
        UserActived $actived,
        UserIdRole $idRole
    ): ?User
    {
        $this->eloquentUserModel->findOrFail($id->value())->update([
            'nombres'=>$firstName->value(),
            'apellidos'=>$lastName->value(),
            'correo'=>$email->value(),
            'telefono'=>$phone->value(),
            'idEstado'=>$actived->value(),
            'idRol'=>$idRole->value()
        ]);

        $OUser = $this->eloquentUserModel->with('modulos')->findOrFail($id->value());

        $user = new User(
            new UserId( $OUser->id ),
            new UserUserName( $OUser->usuario ),
            new UserFirstName( $OUser->nombres ),
            new UserLastName( $OUser->apellidos ),
            new UserEmail( $OUser->correo ),
            new UserPhone( $OUser->telefono ),
            new UserLevel( $OUser->idNivel ),
            new UserActived( $OUser->idEstado ),
            new UserDeleted( $OUser->idEliminado ),
            new UserIdClient( $OUser->idCliente ),
            new UserIdRole( $OUser->idRol )
        );

        $modulos = is_null($OUser->modulos) ? null : $OUser->modulos;
        $arrModulos = [];

        if( $modulos ){
            foreach ( $modulos as $modulo ){
                $arrModulos[] = Module::createEntity($modulo);
            }
        }

        $user->setModules($arrModulos);

        return $user;
    }

    public function find(UserId $id): ?User
    {
        $OUser = $this->eloquentUserModel->with('modulos')->findOrFail($id->value());

        $user = new User(
            new UserId( $OUser->id ),
            new UserUserName( $OUser->usuario ),
            new UserFirstName( $OUser->nombres ),
            new UserLastName( $OUser->apellidos ),
            new UserEmail( $OUser->correo ),
            new UserPhone( $OUser->telefono ),
            new UserLevel( $OUser->idNivel ),
            new UserActived( $OUser->idEstado ),
            new UserDeleted( $OUser->idEliminado ),
            new UserIdClient( $OUser->idCliente ),
            new UserIdRole( $OUser->idRol )
        );

        $modulos = is_null($OUser->modulos) ? null : $OUser->modulos;
        $arrModulos = [];

        if( $modulos ){
            foreach ( $modulos as $modulo ){
                $arrModulos[] = Module::createEntity($modulo);
            }
        }

        $user->setModules($arrModulos);

        return $user;
    }

    public function trash(UserId $id): void
    {
        $this->eloquentUserModel->withTrashed()->findOrFail( $id->value() )->delete();
    }

    public function restore(UserId $id): void
    {
        $this->eloquentUserModel->withTrashed()->findOrFail( $id->value() )->restore();
    }

    public function delete(UserId $id): void
    {
        $this->eloquentUserModel->withTrashed()->findOrFail( $id->value() )->forceDelete();
    }

    public function updatePassword( UserId $id, UserPassword $password ): void
    {
        $this->eloquentUserModel->findOrFail( $id->value())->update([
            'clave' => $password->value(),
        ]);
    }

    public function assignModules( UserId $id, array $modules ): User
    {
        $user = $this->eloquentUserModel->findOrFail( $id->value());
        $user->modulos()->sync($modules, ['id_user' => $id->value()]);

        $OUser = $this->eloquentUserModel->with('modulos')->findOrFail($id->value());

        $User = new User(
            new UserId( $OUser->id ),
            new UserUserName( $OUser->usuario ),
            new UserFirstName( $OUser->nombres ),
            new UserLastName( $OUser->apellidos ),
            new UserEmail( $OUser->correo ),
            new UserPhone( $OUser->telefono ),
            new UserLevel( $OUser->idNivel ),
            new UserActived( $OUser->idEstado ),
            new UserDeleted( $OUser->idEliminado ),
            new UserIdClient( $OUser->idCliente ),
            new UserIdRole( $OUser->idRol )
        );

        $modulos = is_null($OUser->modulos) ? null : $OUser->modulos;
        $arrModulos = [];

        if( $modulos ){
            foreach ( $modulos as $modulo ){
                $arrModulos[] = Module::createEntity($modulo);
            }
        }

        $User->setModules($arrModulos);

        return $User;
    }

    public function assignVehicles( UserId $id, array $vehicles, array $ids ): void
    {
        $user = $this->eloquentUserModel->findOrFail( $id->value());
        //$user->vehicles()->sync($vehicles, ['id_user' => $id->value(), 'id' => \Ramsey\Uuid\Uuid::uuid4()->toString()]);
        $user->vehicles()->detach();

        foreach ( $vehicles as $key => $item) {
            $this->eloquentUserVehicleModel->create([
                'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'id_user' => $id->value(),
                'id_vehicle' => $item
            ]);
        }



    }

    public function updateActived( UserId $id, UserActived $actived ): void
    {
        $this->eloquentUserModel->findOrFail( $id->value())->update([
            'idEstado' => $actived->value(),
        ]);
    }

    public function collectionByClient( ClientId $clientId ): array
    {
        $collection = [];

        $users = $this->eloquentUserModel->with('modulos')->where('idCliente',$clientId->value())->get();

        foreach( $users as $user ){

            $OUser = new User(
                new UserId( $user->id ),
                new UserUserName( $user->usuario ),
                new UserFirstName( $user->nombres ),
                new UserLastName( $user->apellidos ),
                new UserEmail( $user->correo ),
                new UserPhone( $user->telefono ),
                new UserLevel( $user->idNivel ),
                new UserActived( $user->idEstado ),
                new UserDeleted( $user->idEliminado ),
                new UserIdClient( $user->idCliente ),
                new UserIdRole( $user->idRol )
            );

            $modulos = is_null($user->modulos) ? null : $user->modulos;
            $arrModulos = [];

            if( $modulos ){
                foreach ( $modulos as $modulo ){
                    $arrModulos[] = Module::createEntity($modulo);
                }
            }

            $OUser->setModules($arrModulos);

            $collection[] = $OUser;
        }

        return $collection;
    }

    public function collectionTrashByClient( ClientId $clientId ): array
    {
        $collection = [];

        $users = $this->eloquentUserModel->onlyTrashed()->where('idCliente',$clientId->value())->get();

        foreach( $users as $user ){
            $OUser = new User(
                new UserId( $user->id ),
                new UserUserName( $user->usuario ),
                new UserFirstName( $user->nombres ),
                new UserLastName( $user->apellidos ),
                new UserEmail( $user->correo ),
                new UserPhone( $user->telefono ),
                new UserLevel( $user->idNivel ),
                new UserActived( $user->idEstado ),
                new UserDeleted( $user->idEliminado ),
                new UserIdClient( $user->idCliente ),
                new UserIdRole( $user->idRol )
            );

            $modulos = is_null($user->modulos) ? null : $user->modulos;
            $arrModulos = [];

            if( $modulos ){
                foreach ( $modulos as $modulo ){
                    $arrModulos[] = Module::createEntity($modulo);
                }
            }

            $OUser->setModules($arrModulos);

            $collection[] = $OUser;
        }

        return $collection;
    }

    public function vehicleCollectionByUser(UserId $userId): array
    {
        $vehicles = $this->eloquentUserVehicleModel
            ->select('vehicles.*')
                        ->join('vehicles','user_vehicles.id_vehicle','=','vehicles.id')
                        ->where('id_user',$userId->value())
                        ->get();

        $arrVehicles = array();

        foreach ( $vehicles as $vehicle ){
            $arrVehicles[] = new SmallVehicle(
                new VehicleId( $vehicle->id ),
                new VehiclePlate( $vehicle->plate ),
                new VehicleUnit( $vehicle->unit )
            );
        }

        return $arrVehicles;
    }

}
