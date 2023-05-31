<?php

declare(strict_types=1);

namespace Src\Admin\Client\Domain;


use Src\Admin\Client\Domain\ValueObjects\ClientAddress;
use Src\Admin\Client\Domain\ValueObjects\ClientBussinessName;
use Src\Admin\Client\Domain\ValueObjects\ClientDni;
use Src\Admin\Client\Domain\ValueObjects\ClientEmail;
use Src\Admin\Client\Domain\ValueObjects\ClientFirstName;
use Src\Admin\Client\Domain\ValueObjects\ClientIdParent;
use Src\Admin\Client\Domain\ValueObjects\ClientLastName;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Client\Domain\ValueObjects\ClientPhone;
use Src\Admin\Client\Domain\ValueObjects\ClientRuc;
use Src\Admin\Client\Domain\ValueObjects\ClientType;

final class Client
{
    /**
     * @var ClientId
     */
    private $id;
    /**
     * @var ClientBussinessName
     */
    private $bussinessName;
    /**
     * @var ClientFirstName
     */
    private $firstName;
    /**
     * @var ClientLastName
     */
    private $lastName;
    /**
     * @var ClientRuc
     */
    private $ruc;
    /**
     * @var ClientDni
     */
    private $dni;
    /**
     * @var ClientEmail
     */
    private $email;
    /**
     * @var ClientAddress
     */
    private $address;
    /**
     * @var ClientPhone
     */
    private $phone;
    /**
     * @var ClientType
     */
    private $type;
    /**
     * @var ClientIdParent
     */
    private $idParent;

    /**
     * @var []
     */
    private $clients;

    /**
     * Client constructor.
     * @param ClientId $id
     * @param ClientBussinessName $bussinessName
     * @param ClientFirstName $firstName
     * @param ClientLastName $lastName
     * @param ClientRuc $ruc
     * @param ClientDni $dni
     * @param ClientEmail $email
     * @param ClientAddress $address
     * @param ClientPhone $phone
     * @param ClientType $type
     * @param ClientIdParent $idParent
     */
    public function __construct(
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
    )
    {

        $this->id = $id;
        $this->bussinessName = $bussinessName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->ruc = $ruc;
        $this->dni = $dni;
        $this->email = $email;
        $this->address = $address;
        $this->phone = $phone;
        $this->type = $type;
        $this->idParent = $idParent;
    }

    /**
     * @return ClientId
     */
    public function getId(): ClientId
    {
        return $this->id;
    }

    /**
     * @return ClientBussinessName
     */
    public function getBussinessName(): ClientBussinessName
    {
        return $this->bussinessName;
    }

    /**
     * @return ClientFirstName
     */
    public function getFirstName(): ClientFirstName
    {
        return $this->firstName;
    }

    /**
     * @return ClientLastName
     */
    public function getLastName(): ClientLastName
    {
        return $this->lastName;
    }

    /**
     * @return ClientRuc
     */
    public function getRuc(): ClientRuc
    {
        return $this->ruc;
    }

    /**
     * @return ClientDni
     */
    public function getDni(): ClientDni
    {
        return $this->dni;
    }

    /**
     * @return ClientEmail
     */
    public function getEmail(): ClientEmail
    {
        return $this->email;
    }

    /**
     * @return ClientAddress
     */
    public function getAddress(): ClientAddress
    {
        return $this->address;
    }

    /**
     * @return ClientPhone
     */
    public function getPhone(): ClientPhone
    {
        return $this->phone;
    }

    /**
     * @return ClientType
     */
    public function getType(): ClientType
    {
        return $this->type;
    }

    /**
     * @return ClientIdParent
     */
    public function getIdParent(): ClientIdParent
    {
        return $this->idParent;
    }


    /**
     * @return array
     */
    public function getClients(): array
    {
        return $this->clients;
    }

    /**
     * @param array $clients
     */
    public function setClients( array $clients ): void
    {
        $this->clients = $clients;
    }



    public static function createEntity( $request ): Client
    {
        return new self(
            new ClientId( $request->id ),
            new ClientBussinessName( $request->bussiness_name ),
            new ClientFirstName( $request->first_name ),
            new ClientLastName( $request->last_name ),
            new ClientRuc( $request->ruc ),
            new ClientDni( $request->dni ),
            new ClientEmail( $request->email ),
            new ClientAddress( $request->address ),
            new ClientPhone( $request->phone ),
            new ClientType( $request->type ),
            new ClientIdParent( $request->id_parent_client )
        );
    }

}
