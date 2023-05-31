<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketMachine\Domain;

use Src\ModelBase\Domain\ValueObjects\DateFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineDeleted;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineId;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineIdClient;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineIdVehicle;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineImei;

final class TicketMachine
{

    /**
     * @var TicketMachineId
     */
    private $id;
    /**
     * @var TicketMachineImei
     */
    private $imei;
    /**
     * @var TicketMachineDeleted
     */
    private $deleted;
    /**
     * @var TicketMachineIdClient
     */
    private $idClient;
    /**
     * @var TicketMachineIdVehicle
     */
    private $idVehicle;


    // Secondary

    /**
     * @var Id
     */
    private $idUserCreated;
    /**
     * @var Id
     */
    private $idUserUpdated;
    /**
     * @var DateFormat
     */
    private $createdAt;
    /**
     * @var DateFormat
     */
    private $updatedAt;


    private $client = null;
    private $vehicle = null;
    private $userCreated = null;
    private $userUpdated = null;

    public function __construct(
        TicketMachineId $id,
        TicketMachineImei $imei,
        TicketMachineDeleted $deleted,
        TicketMachineIdClient $idClient,
        TicketMachineIdVehicle $idVehicle
    )
    {

        $this->id = $id;
        $this->imei = $imei;
        $this->deleted = $deleted;
        $this->idClient = $idClient;
        $this->idVehicle = $idVehicle;
    }

    /**
     * @return TicketMachineId
     */
    public function getId(): TicketMachineId
    {
        return $this->id;
    }

    /**
     * @return TicketMachineImei
     */
    public function getImei(): TicketMachineImei
    {
        return $this->imei;
    }

    /**
     * @return TicketMachineDeleted
     */
    public function getDeleted(): TicketMachineDeleted
    {
        return $this->deleted;
    }

    /**
     * @return TicketMachineIdClient
     */
    public function getIdClient(): TicketMachineIdClient
    {
        return $this->idClient;
    }

    /**
     * @return TicketMachineIdVehicle
     */
    public function getIdVehicle(): TicketMachineIdVehicle
    {
        return $this->idVehicle;
    }



    public static function create(
        TicketMachineId $id,
        TicketMachineImei $imei,
        TicketMachineDeleted $deleted,
        TicketMachineIdClient $idClient,
        TicketMachineIdVehicle $idVehicle
    ): TicketMachine
    {
        return new self( $id, $imei, $deleted, $idClient, $idVehicle );
    }




    /**
     * @return Id
     */
    public function getIdUserCreated(): Id
    {
        return $this->idUserCreated;
    }

    /**
     * @param Id $idUserCreated
     */
    public function setIdUserCreated(Id $idUserCreated): void
    {
        $this->idUserCreated = $idUserCreated;
    }

    /**
     * @return Id
     */
    public function getIdUserUpdated(): Id
    {
        return $this->idUserUpdated;
    }

    /**
     * @param Id $idUserUpdated
     */
    public function setIdUserUpdated(Id $idUserUpdated): void
    {
        $this->idUserUpdated = $idUserUpdated;
    }

    /**
     * @return DateFormat
     */
    public function getCreatedAt(): DateFormat
    {
        return $this->createdAt;
    }

    /**
     * @param DateFormat $createdAt
     */
    public function setCreatedAt(DateFormat $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateFormat
     */
    public function getUpdatedAt(): DateFormat
    {
        return $this->updatedAt;
    }

    /**
     * @param DateFormat $updatedAt
     */
    public function setUpdatedAt(DateFormat $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param mixed $vehicle
     */
    public function setVehicle($vehicle): void
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @return mixed
     */
    public function getUserCreated()
    {
        return $this->userCreated;
    }

    /**
     * @param mixed $userCreated
     */
    public function setUserCreated($userCreated): void
    {
        $this->userCreated = $userCreated;
    }

    /**
     * @return mixed
     */
    public function getUserUpdated()
    {
        return $this->userUpdated;
    }

    /**
     * @param mixed $userUpdated
     */
    public function setUserUpdated($userUpdated): void
    {
        $this->userUpdated = $userUpdated;
    }





    public static function createEntity( $request ): TicketMachine
    {
        return new self(
            new TicketMachineId($request->id),
            new TicketMachineImei($request->imei),
            new TicketMachineDeleted($request->deleted),
            new TicketMachineIdClient($request->id_client),
            new TicketMachineIdVehicle($request->id_vehicle)
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'            => $this->getId()->value(),
            'imei'          => $this->getImei()->value(),
            'deleted'         => $this->getDeleted()->value(),
            'id_client'       => $this->getIdClient()->value(),
            'id_vehicle'       => $this->getIdVehicle()->value()
        ];
    }
}
