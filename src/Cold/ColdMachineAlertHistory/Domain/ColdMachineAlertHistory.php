<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlertHistory\Domain;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachine\Domain\ColdMachine;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachineAlert\Domain\ColdMachineAlert;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAId;
use Src\Cold\ColdMachineAlertHistory\Domain\ValueObjects\CMAHAttended;
use Src\Cold\ColdMachineAlertHistory\Domain\ValueObjects\CMAHId;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLatitude;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLongitude;
use Src\Utility\UDateTime;

final class ColdMachineAlertHistory
{
    /**
     * @var CMAHId
     */
    private $id;
    /**
     * @var CMAId
     */
    private $alertId;
    /**
     * @var CMId
     */
    private $machineId;
    /**
     * @var CMAHAttended
     */
    private $attended;
    /**
     * @var UserId|null
     */
    private $idUserUpdated;
    /**
     * @var UDateTime|null
     */
    private $dateCreated = null;
    /**
     * @var UDateTime|null
     */
    private $dateUpdated = null;
    /**
     * @var ClientId
     */
    private $clientId;
    /**
     * @var CMHLatitude
     */
    private $latitude;
    /**
     * @var CMHLongitude
     */
    private $longitude;
    /**
     * @var UDateTime
     */
    private $createdAt;
    /**
     * @var ColdMachine | null
     */
    private $machine = null;
    /**
     * @var ColdMachineAlert | null
     */
    private $alert = null;

    /**
     * @var int
     */
    private $count = 0;

    /**
     * ColdMachineAlertHistory constructor.
     * @param CMAHId $id
     * @param CMAId $alertId
     * @param CMId $machineId
     * @param ClientId $clientId
     * @param CMAHAttended $attended
     * @param CMHLatitude $latitude
     * @param CMHLongitude $longitude
     * @param UserId|null $idUserUpdated
     * @param UDateTime $createdAt
     */
    public function __construct(
        CMAHId $id,
        CMAId $alertId,
        CMId $machineId,
        ClientId $clientId,
        CMAHAttended $attended,
        CMHLatitude $latitude,
        CMHLongitude $longitude,
        ?UserId $idUserUpdated,
        UDateTime $createdAt
    )
    {
        $this->id = $id;
        $this->alertId = $alertId;
        $this->machineId = $machineId;
        $this->attended = $attended;
        $this->idUserUpdated = $idUserUpdated;
        $this->clientId = $clientId;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->createdAt = $createdAt;
    }

    /**
     * @return CMAHId
     */
    public function getId(): CMAHId
    {
        return $this->id;
    }

    /**
     * @return CMAId
     */
    public function getAlertId(): CMAId
    {
        return $this->alertId;
    }

    /**
     * @return CMId
     */
    public function getMachineId(): CMId
    {
        return $this->machineId;
    }

    /**
     * @return CMAHAttended
     */
    public function getAttended(): CMAHAttended
    {
        return $this->attended;
    }

    /**
     * @return UserId|null
     */
    public function getIdUserUpdated(): ?UserId
    {
        return $this->idUserUpdated;
    }

    /**
     * @return UDateTime|null
     */
    public function getDateCreated(): ?UDateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param UDateTime|null $dateCreated
     */
    public function setDateCreated(?UDateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return UDateTime|null
     */
    public function getDateUpdated(): ?UDateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @param UDateTime|null $dateUpdated
     */
    public function setDateUpdated(?UDateTime $dateUpdated): void
    {
        $this->dateUpdated = $dateUpdated;
    }

    /**
     * @return ClientId
     */
    public function getClientId(): ClientId
    {
        return $this->clientId;
    }

    /**
     * @return CMHLatitude
     */
    public function getLatitude(): CMHLatitude
    {
        return $this->latitude;
    }

    /**
     * @return CMHLongitude
     */
    public function getLongitude(): CMHLongitude
    {
        return $this->longitude;
    }

    /**
     * @return UDateTime
     */
    public function getCreatedAt(): UDateTime
    {
        return $this->createdAt;
    }

    /**
     * @return ColdMachine|null
     */
    public function getMachine(): ?ColdMachine
    {
        return $this->machine;
    }

    /**
     * @param ColdMachine|null $machine
     */
    public function setMachine(?ColdMachine $machine): void
    {
        $this->machine = $machine;
    }

    /**
     * @return ColdMachineAlert|null
     */
    public function getAlert(): ?ColdMachineAlert
    {
        return $this->alert;
    }

    /**
     * @param ColdMachineAlert|null $alert
     */
    public function setAlert(?ColdMachineAlert $alert): void
    {
        $this->alert = $alert;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }






    public function ToArray( $relation = false ): array{

        $alert = [];
        $machine = [];
        if($relation){
            $alert = [
                'id' => $this->getAlert()->getId()->value(),
                'name' => $this->getAlert()->getText()->value(),
                'description' => $this->getAlert()->getDescription()->value()
            ];
            $machine = [
                'id' => $this->getMachine()->getId()->value(),
                'imei' => $this->getMachine()->getImei()->value(),
                'sim' => $this->getMachine()->getSim()->value()
            ];
        }

        return [
            'id'    => $this->getId()->value(),
            'idAlert'  => $this->getAlertId()->value(),
            'idMachine'  => $this->getMachineId()->value(),
            'idClient'  => $this->getClientId()->value(),
            'attended' => $this->getAttended()->value(),
            'idUserUpdated' => $this->getIdUserUpdated() ? $this->getIdUserUpdated()->value() : null,
            'latitude' => $this->getLatitude()->value(),
            'longitude' => $this->getLongitude()->value(),
            'createdAt' => $this->getCreatedAt()->value(),
            'alert' => $alert,
            'machine' => $machine
        ];
    }


}
