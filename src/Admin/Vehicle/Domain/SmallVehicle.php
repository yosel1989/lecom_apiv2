<?php
declare(strict_types=1);

namespace Src\Admin\Vehicle\Domain;


use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;
use Src\Admin\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleUnit;


final class SmallVehicle
{
    private  $id;
    private  $plate;
    private  $unit;

    /**
     * @param VehicleId $id
     * @param VehiclePlate $plate
     * @param VehicleUnit $unit
     */
    public function __construct(
        VehicleId $id,
        VehiclePlate $plate,
        VehicleUnit $unit
    )
    {
        $this->id = $id;
        $this->plate = $plate;
        $this->unit = $unit;
    }

    /**
     * @return VehicleId
     */
    public function getId(): VehicleId
    {
        return $this->id;
    }

    /**
     * @return VehiclePlate
     */
    public function getPlate(): VehiclePlate
    {
        return $this->plate;
    }

    /**
     * @return VehicleUnit
     */
    public function getUnit(): VehicleUnit
    {
        return $this->unit;
    }



}
