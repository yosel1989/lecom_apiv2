<?php
declare(strict_types=1);

namespace Src\General\Vehicle\Domain;

use Src\General\Vehicle\Domain\ValueObjects\VehicleDeleted;
use Src\General\Vehicle\Domain\ValueObjects\VehicleId;
use Src\General\Vehicle\Domain\ValueObjects\VehicleIdCategory;
use Src\General\Vehicle\Domain\ValueObjects\VehicleIdClass;
use Src\General\Vehicle\Domain\ValueObjects\VehicleIdClient;
use Src\General\Vehicle\Domain\ValueObjects\VehicleIdModel;
use Src\General\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\General\Vehicle\Domain\ValueObjects\VehicleUnit;

final class Vehicle
{
    /**
     * @var VehicleId
     */
    private $id;
    /**
     * @var VehiclePlate
     */
    private $plate;
    /**
     * @var VehicleUnit
     */
    private $unit;
    /**
     * @var VehicleDeleted
     */
    private $deleted;
    /**
     * @var VehicleIdClient
     */
    private $idClient;
    /**
     * @var VehicleIdCategory
     */
    private $idCategory;
    /**
     * @var VehicleIdModel
     */
    private $idModel;
    /**
     * @var VehicleIdClass
     */
    private $idClass;

    /**
     * Vehicle constructor.
     * @param VehicleId $id
     * @param VehiclePlate $plate
     * @param VehicleUnit $unit
     * @param VehicleDeleted $deleted
     * @param VehicleIdClient $idClient
     * @param VehicleIdCategory $idCategory
     * @param VehicleIdModel $idModel
     * @param VehicleIdClass $idClass
     */
    public function __construct(
        VehicleId $id,
        VehiclePlate $plate,
        VehicleUnit $unit,
        VehicleDeleted $deleted,
        VehicleIdClient $idClient,
        VehicleIdCategory $idCategory,
        VehicleIdModel $idModel,
        VehicleIdClass $idClass
    )
    {

        $this->id = $id;
        $this->plate = $plate;
        $this->unit = $unit;
        $this->deleted = $deleted;
        $this->idClient = $idClient;
        $this->idCategory = $idCategory;
        $this->idModel = $idModel;
        $this->idClass = $idClass;
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

    /**
     * @return VehicleDeleted
     */
    public function getDeleted(): VehicleDeleted
    {
        return $this->deleted;
    }

    /**
     * @return VehicleIdClient
     */
    public function getIdClient(): VehicleIdClient
    {
        return $this->idClient;
    }

    /**
     * @return VehicleIdCategory
     */
    public function getIdCategory(): VehicleIdCategory
    {
        return $this->idCategory;
    }

    /**
     * @return VehicleIdModel
     */
    public function getIdModel(): VehicleIdModel
    {
        return $this->idModel;
    }

    /**
     * @return VehicleIdClass
     */
    public function getIdClass(): VehicleIdClass
    {
        return $this->idClass;
    }

    public static function createEntity( $request ): Vehicle
    {
        return new self(
            new VehicleId($request->id),
            new VehiclePlate($request->plate),
            new VehicleUnit($request->unit),
            new VehicleDeleted($request->deleted),
            new VehicleIdClient($request->id_client),
            new VehicleIdCategory($request->id_category),
            new VehicleIdModel($request->id_model),
            new VehicleIdClass($request->id_class)
        );
    }

    /**
     * @param array $vehicleArray
     * @return array
     */
    public static function getIdList(array $vehicleArray  ): array{
        $arrId = [];
        foreach( $vehicleArray as $vehicle ){
            $arrId[] = $vehicle->getId()->value();
        }
        return $arrId;
    }
}
