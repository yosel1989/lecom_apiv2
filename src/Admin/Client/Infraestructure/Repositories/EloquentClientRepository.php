<?php


namespace Src\Admin\Client\Infraestructure\Repositories;


use App\Models\Admin\Client as EloquentClientModel;
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

    public function __construct()
    {
        $this->eloquentClientModel = new EloquentClientModel;
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
        $OClient = $this->eloquentClientModel->create([
            'id'=>$id->value(),
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
