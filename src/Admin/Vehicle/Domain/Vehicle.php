<?php
declare(strict_types=1);

namespace Src\Admin\Vehicle\Domain;

use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdBrand;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdFleet;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleDeleted;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdCategory;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdClass;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdClient;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdModel;
use Src\Admin\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleUnit;
use Src\Admin\VehicleBrand\Domain\VehicleBrand;
use Src\Admin\VehicleClass\Domain\VehicleClass;
use Src\Admin\VehicleFleet\Domain\VehicleFleet;
use Src\Admin\VehicleModel\Domain\VehicleModel;

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
     * @var VehicleIdFleet
     */
    private $idFleet;
    /**
     * @var VehicleBrand | null
     */
    private $brand;
    /**
     * @var VehicleModel | null
     */
    private $model;
    /**
     * @var VehicleClass | null
     */
    private $class;
    /**
     * @var VehicleFleet | null
     */
    private $fleet;
    /**
     * @var VehicleIdBrand
     */
    private $idBrand;

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
     * @param VehicleIdFleet $idFleet
     * @param VehicleIdBrand $idBrand
     */
    public function __construct(
        VehicleId $id,
        VehiclePlate $plate,
        VehicleUnit $unit,
        VehicleDeleted $deleted,
        VehicleIdClient $idClient,
        VehicleIdCategory $idCategory,
        VehicleIdModel $idModel,
        VehicleIdClass $idClass,
        VehicleIdFleet $idFleet,
        VehicleIdBrand $idBrand
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
        $this->idFleet = $idFleet;
        $this->idBrand = $idBrand;
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

    /**
     * @return VehicleIdFleet
     */
    public function getIdFleet(): VehicleIdFleet
    {
        return $this->idFleet;
    }

    /**
     * @return VehicleIdBrand
     */
    public function getIdBrand(): VehicleIdBrand
    {
        return $this->idBrand;
    }



    /**
     * @return VehicleBrand|null
     */
    public function getBrand(): ?VehicleBrand
    {
        return $this->brand;
    }

    /**
     * @param VehicleBrand|null $brand
     */
    public function setBrand(?VehicleBrand $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return VehicleModel|null
     */
    public function getModel(): ?VehicleModel
    {
        return $this->model;
    }

    /**
     * @param VehicleModel|null $model
     */
    public function setModel(?VehicleModel $model): void
    {
        $this->model = $model;
    }

    /**
     * @return VehicleClass|null
     */
    public function getClass(): ?VehicleClass
    {
        return $this->class;
    }

    /**
     * @param VehicleClass|null $class
     */
    public function setClass(?VehicleClass $class): void
    {
        $this->class = $class;
    }

    /**
     * @return VehicleFleet|null
     */
    public function getFleet(): ?VehicleFleet
    {
        return $this->fleet;
    }

    /**
     * @param VehicleFleet|null $fleet
     */
    public function setFleet(?VehicleFleet $fleet): void
    {
        $this->fleet = $fleet;
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
            new VehicleIdClass($request->id_class),
            new VehicleIdFleet($request->id_fleet),
            new VehicleIdBrand($request->id_brand)
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
