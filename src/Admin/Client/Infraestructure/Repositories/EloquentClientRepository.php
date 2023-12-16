<?php


namespace Src\Admin\Client\Infraestructure\Repositories;


use App\Models\Admin\Client as EloquentClientModel;
use App\Models\V2\Cliente as EloquentClienteModel;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Src\Admin\Client\Domain\Client;
use Src\Admin\Client\Domain\Contracts\ClientRepositoryContract;
use Src\Admin\Client\Domain\ValueObjects\ClientAddress;
use Src\Admin\Client\Domain\ValueObjects\ClientBussinessName;
use Src\Admin\Client\Domain\ValueObjects\ClientDni;
use Src\Admin\Client\Domain\ValueObjects\ClientEmail;
use Src\Admin\Client\Domain\ValueObjects\ClientFirstName;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Client\Domain\ValueObjects\ClientIdParent;
use Src\Admin\Client\Domain\ValueObjects\ClientLastName;
use Src\Admin\Client\Domain\ValueObjects\ClientPhone;
use Src\Admin\Client\Domain\ValueObjects\ClientRuc;
use Src\Admin\Client\Domain\ValueObjects\ClientType;

final class EloquentClientRepository implements ClientRepositoryContract
{
    /**
     * @var EloquentClientModel
     */
    private $eloquentClientModel;

    /**
     * @var EloquentClienteModel
     */
    private $eloquentClienteModel;

    public function __construct()
    {
        $this->eloquentClientModel = new EloquentClientModel;
        $this->eloquentClienteModel = new EloquentClienteModel;
    }

    public function create(
        ClientId $id,
        ClientBussinessName $bussinessName,
        ClientFirstName $firstName,
        ClientLastName $lastName,
        ClientRuc $ruc,
        ClientDni $dni,
        ClientEmail $email,
        ClientAddress $address,
        ClientPhone $phone,
        ClientType $type,
        ClientIdParent $idParent
    ): ?Client
    {
        $count = DB::table('clients')->count();
        $OClient = $this->eloquentClientModel->create([
            'id'=>$id->value(),
            'codigo' => ($count + 1),
            'bussiness_name'=>$bussinessName->value(),
            'first_name'=>$firstName->value(),
            'last_name'=>$lastName->value(),
            'ruc'=>$ruc->value(),
            'dni'=>$dni->value(),
            'email'=>$email->value(),
            'address'=>$address->value(),
            'phone'=>$phone->value(),
            'type'=>$type->value(),
            'id_parent_client'=>$idParent->value()
        ]);

        if (!Schema::hasTable('boleto_interprovincial_cliente_' . ($count + 1))) {
            DB::statement("CREATE TABLE boleto_interprovincial_cliente_' . ($count + 1) . ' LIKE boleto_interprovincial");
        }

//        Schema::create('boleto_interprovincial_' . ($count + 1), function (Blueprint $table) {
//            $table->uuid('id')->unique()->primary();
//            $table->uuid('idDestino')->nullable();
//            $table->uuid('idVehiculo')->nullable();
//            $table->uuid('idCliente')->nullable();
//            $table->string('numeroDocumento',20)->nullable();
//            $table->string('codigoBoleto',30)->nullable();
//            $table->decimal('latitud',10,8)->nullable();
//            $table->decimal('longitud',10,8)->nullable();
//            $table->decimal('precio',5,2);
//            $table->dateTime('fecha');
//            $table->tinyInteger('idEstado')->default(1);
//            $table->tinyInteger('idEliminado')->default(0);
//            $table->uuid('idUsuarioRegistro');
//            $table->uuid('idUsuarioModifico')->nullable();
//            $table->timestamp('fechaRegistro');
//            $table->timestamp('fechaModifico')->nullable();
//        });

        $count = DB::table('clientes')->count();
        $this->eloquentClienteModel->create([
            'codigo' => ($count + 1),
            'nombre'=>$bussinessName->value(),
            'nombreContacto'=>$firstName->value() . ' ' . $lastName->value() ,
            'numeroDocumento'=> ($ruc->value() ? $ruc->value() :  $dni->value()),
            'correo'=>$email->value(),
            'direccion'=>$address->value(),
            'telefono1'=>$phone->value(),
            'idTipo'=>$type->value(),
            'idClientePadre'=>$idParent->value()
        ]);

        return new Client(
            new ClientId( $OClient->id ),
            new ClientBussinessName( $OClient->bussiness_name ),
            new ClientFirstName( $OClient->first_name ),
            new ClientLastName( $OClient->last_name ),
            new ClientRuc( $OClient->ruc ),
            new ClientDni( $OClient->dni ),
            new ClientEmail( $OClient->email ),
            new ClientAddress( $OClient->address ),
            new ClientPhone( $OClient->phone ),
            new ClientType( $OClient->type ),
            new ClientIdParent( $OClient->id_parent_client )
        );
    }

    public function update(
        ClientId $id,
        ClientBussinessName $bussinessName,
        ClientFirstName $firstName,
        ClientLastName $lastName,
        ClientRuc $ruc,
        ClientDni $dni,
        ClientEmail $email,
        ClientAddress $address,
        ClientPhone $phone,
        ClientType $type
    ): ?Client
    {
        $OClient = tap( $this->eloquentClientModel->findOrFail($id->value()) )->update([
            'bussiness_name'=>$bussinessName->value(),
            'first_name'=>$firstName->value(),
            'last_name'=>$lastName->value(),
            'ruc'=>$ruc->value(),
            'dni'=>$dni->value(),
            'email'=>$email->value(),
            'address'=>$address->value(),
            'phone'=>$phone->value(),
            'type'=>$type->value()
        ]);


        return new Client(
            new ClientId( $OClient->id ),
            new ClientBussinessName( $OClient->bussiness_name ),
            new ClientFirstName( $OClient->first_name ),
            new ClientLastName( $OClient->last_name ),
            new ClientRuc( $OClient->ruc ),
            new ClientDni( $OClient->dni ),
            new ClientEmail( $OClient->email ),
            new ClientAddress( $OClient->address ),
            new ClientPhone( $OClient->phone ),
            new ClientType( $OClient->type ),
            new ClientIdParent( $OClient->id_parent_client )
        );
    }

    public function find( ClientId $id ): ?Client
    {
        $OClient = $this->eloquentClientModel->findOrFail($id->value());

        return new Client(
            new ClientId( $OClient->id ),
            new ClientBussinessName( $OClient->bussiness_name ),
            new ClientFirstName( $OClient->first_name ),
            new ClientLastName( $OClient->last_name ),
            new ClientRuc( $OClient->ruc ),
            new ClientDni( $OClient->dni ),
            new ClientEmail( $OClient->email ),
            new ClientAddress( $OClient->address ),
            new ClientPhone( $OClient->phone ),
            new ClientType( $OClient->type ),
            new ClientIdParent( $OClient->id_parent_client )
        );
    }

    public function trash( ClientId $id ): void
    {
        $this->eloquentClientModel->withTrashed()->findOrFail( $id->value() )->delete();
    }

    public function delete( ClientId $id ): void
    {
        $this->eloquentClientModel->withTrashed()->findOrFail( $id->value() )->forceDelete();
    }

    public function restore( ClientId $id ): void
    {
        $this->eloquentClientModel->withTrashed()->findOrFail( $id->value() )->restore();
    }

    public function collection( ): array
    {
        $collection = [];

        $clients = $this->eloquentClientModel->with('clients')->where('type',0)->get();

        foreach( $clients as $client ){
            $childrenClients = [];
            $OClient = new Client(
                new ClientId( $client->id ),
                new ClientBussinessName( $client->bussiness_name ),
                new ClientFirstName( $client->first_name ),
                new ClientLastName( $client->last_name ),
                new ClientRuc( $client->ruc ),
                new ClientDni( $client->dni ),
                new ClientEmail( $client->email ),
                new ClientAddress( $client->address ),
                new ClientPhone( $client->phone ),
                new ClientType( $client->type ),
                new ClientIdParent( $client->id_parent_client )
            );
            if ( $client->clients ){
                $childrens = $client->clients;
                foreach($childrens as $children){
                    $childrenClients[] = Client::createEntity($children);
                }
            }
            $OClient->setClients($childrenClients);
            $collection[] = $OClient;
        }

        return $collection;
    }

    public function collectionTrash( ): array
    {
        $collection = [];

        $clients = $this->eloquentClientModel->onlyTrashed()->get();

        foreach( $clients as $client ){
            $OClient = new Client(
                new ClientId( $client->id ),
                new ClientBussinessName( $client->bussiness_name ),
                new ClientFirstName( $client->first_name ),
                new ClientLastName( $client->last_name ),
                new ClientRuc( $client->ruc ),
                new ClientDni( $client->dni ),
                new ClientEmail( $client->email ),
                new ClientAddress( $client->address ),
                new ClientPhone( $client->phone ),
                new ClientType( $client->type ),
                new ClientIdParent( $client->id_parent_client )
            );
            $collection[] = $OClient;
        }

        return $collection;
    }

    public function collectionByParent( ClientIdParent $idParent ): array
    {
        $collection = [];

        $clients = $this->eloquentClientModel->where('id_parent_client',$idParent->value())->get();

        foreach( $clients as $client ){
            $OClient = new Client(
                new ClientId( $client->id ),
                new ClientBussinessName( $client->bussiness_name ),
                new ClientFirstName( $client->first_name ),
                new ClientLastName( $client->last_name ),
                new ClientRuc( $client->ruc ),
                new ClientDni( $client->dni ),
                new ClientEmail( $client->email ),
                new ClientAddress( $client->address ),
                new ClientPhone( $client->phone ),
                new ClientType( $client->type ),
                new ClientIdParent( $client->id_parent_client )
            );
            $collection[] = $OClient;
        }

        return $collection;
    }

    public function collectionTrashByParent( ClientIdParent $idParent ): array
    {
        $collection = [];

        $clients = $this->eloquentClientModel->onlyTrashed()->where('id_parent_client',$idParent->value())->get();

        foreach( $clients as $client ){
            $OClient = new Client(
                new ClientId( $client->id ),
                new ClientBussinessName( $client->bussiness_name ),
                new ClientFirstName( $client->first_name ),
                new ClientLastName( $client->last_name ),
                new ClientRuc( $client->ruc ),
                new ClientDni( $client->dni ),
                new ClientEmail( $client->email ),
                new ClientAddress( $client->address ),
                new ClientPhone( $client->phone ),
                new ClientType( $client->type ),
                new ClientIdParent( $client->id_parent_client )
            );
            $collection[] = $OClient;
        }

        return $collection;
    }

}
