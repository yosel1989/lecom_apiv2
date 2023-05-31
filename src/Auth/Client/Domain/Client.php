<?php

declare(strict_types=1);

namespace Src\Auth\Client\Domain;


use Src\Auth\Client\Domain\ValueObjects\ClientAddress;
use Src\Auth\Client\Domain\ValueObjects\ClientBussinessName;
use Src\Auth\Client\Domain\ValueObjects\ClientDeleted;
use Src\Auth\Client\Domain\ValueObjects\ClientDni;
use Src\Auth\Client\Domain\ValueObjects\ClientEmail;
use Src\Auth\Client\Domain\ValueObjects\ClientFirstName;
use Src\Auth\Client\Domain\ValueObjects\ClientId;
use Src\Auth\Client\Domain\ValueObjects\ClientIdParentClient;
use Src\Auth\Client\Domain\ValueObjects\ClientLastName;
use Src\Auth\Client\Domain\ValueObjects\ClientPhone;
use Src\Auth\Client\Domain\ValueObjects\ClientRuc;
use Src\Auth\Client\Domain\ValueObjects\ClientType;

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
     * @var ClientDeleted
     */
    private $deleted;
    /**
     * @var ClientIdParentClient
     */
    private $idParentClient;

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
     * @param ClientDeleted $deleted
     * @param ClientIdParentClient $idParentClient
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
        ClientDeleted $deleted,
        ClientIdParentClient $idParentClient
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
        $this->deleted = $deleted;
        $this->idParentClient = $idParentClient;
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
     * @return ClientDeleted
     */
    public function getDeleted(): ClientDeleted
    {
        return $this->deleted;
    }

    /**
     * @return ClientIdParentClient
     */
    public function getIdParentClient(): ClientIdParentClient
    {
        return $this->idParentClient;
    }

    public static function create(
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
        ClientDeleted $deleted,
        ClientIdParentClient $idParentClient
    ): Client
    {
        return new self( $id, $bussinessName, $firstName, $lastName, $ruc, $dni, $email, $address, $phone, $type, $deleted, $idParentClient );
    }

    public static function createEntity( $response ): Client
    {
        return new self(
            new ClientId( $response->id ),
            new ClientBussinessName( $response->bussiness_name ),
            new ClientFirstName( $response->first_name ),
            new ClientLastName( $response->last_name ),
            new ClientRuc( $response->ruc ),
            new ClientDni( $response->dni ),
            new ClientEmail( $response->email ),
            new ClientAddress( $response->address ),
            new ClientPhone( $response->phone ),
            new ClientType( $response->type ),
            new ClientDeleted( $response->deleted ),
            new ClientIdParentClient( $response->id_parent_client )
        );
    }


    public function toArray(): array
    {
        return [
            'id'                    => $this->getId()->value(),
            'bussiness_name'        => $this->getBussinessName()->value(),
            'first_name'            => $this->getFirstName()->value(),
            'last_name'             => $this->getLastName()->value(),
            'ruc'                   => $this->getRuc()->value(),
            'dni'                   => $this->getDni()->value(),
            'email'                 => $this->getEmail()->value(),
            'address'               => $this->getAddress()->value(),
            'phone'                 => $this->getPhone()->value(),
            'type'                  => $this->getType()->value(),
            'deleted'               => $this->getDeleted()->value(),
            'id_parent_client'      => $this->getIdParentClient()->value(),
        ];
    }
}
