<?php

declare(strict_types=1);

namespace Src\Admin\VehicleFleet\Domain;


use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\VehicleFleet\Domain\ValueObjects\VehicleFleetDeleted;
use Src\Admin\VehicleFleet\Domain\ValueObjects\VehicleFleetId;
use Src\Admin\VehicleFleet\Domain\ValueObjects\VehicleFleetIdClient;
use Src\Admin\VehicleFleet\Domain\ValueObjects\VehicleFleetName;

final class VehicleFleet
{
    /**
     * @var VehicleFleetId
     */
    private $id;
    /**
     * @var VehicleFleetName
     */
    private $name;
    /**
     * @var VehicleFleetDeleted
     */
    private $deleted;
    /**
     * @var ClientId
     */
    private $idClient;

    /**
     * VehicleFleet constructor.
     * @param VehicleFleetId $id
     * @param VehicleFleetName $name
     * @param VehicleFleetDeleted $deleted
     * @param ClientId $idClient
     */
    public function __construct(
        VehicleFleetId  $id,
        VehicleFleetName $name,
        VehicleFleetDeleted $deleted,
        ClientId $idClient
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->deleted = $deleted;
        $this->idClient = $idClient;
    }

    /**
     * @return VehicleFleetId
     */
    public function getId(): VehicleFleetId
    {
        return $this->id;
    }

    /**
     * @return VehicleFleetName
     */
    public function getName(): VehicleFleetName
    {
        return $this->name;
    }

    /**
     * @return VehicleFleetDeleted
     */
    public function getDeleted(): VehicleFleetDeleted
    {
        return $this->deleted;
    }

    /**
     * @return ClientId
     */
    public function getIdClient(): ClientId
    {
        return $this->idClient;
    }

    public static function createEntity( $request ): VehicleFleet
    {
        return new self(
            new VehicleFleetId( $request->id ),
            new VehicleFleetName( $request->name ),
            new VehicleFleetDeleted( $request->deleted ),
            new ClientId( $request->id_client )
        );
    }
}
