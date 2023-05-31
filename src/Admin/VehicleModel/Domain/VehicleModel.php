<?php

declare(strict_types=1);

namespace Src\Admin\VehicleModel\Domain;


use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandId;
use Src\Admin\VehicleBrand\Domain\VehicleBrand;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelDeleted;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelId;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelName;

final class VehicleModel
{
    /**
     * @var VehicleModelId
     */
    private $id;
    /**
     * @var VehicleModelName
     */
    private $name;
    /**
     * @var VehicleModelDeleted
     */
    private $deleted;
    /**
     * @var VehicleBrandId
     */
    private $idBrand;

    private $brand;

    /**
     * VehicleModel constructor.
     * @param VehicleModelId $id
     * @param VehicleModelName $name
     * @param VehicleModelDeleted $deleted
     * @param VehicleBrandId $idBrand
     */
    public function __construct(
        VehicleModelId  $id,
        VehicleModelName $name,
        VehicleModelDeleted $deleted,
        VehicleBrandId $idBrand
    )
    {

        $this->id = $id;
        $this->name = $name;
        $this->deleted = $deleted;
        $this->idBrand = $idBrand;
    }

    /**
     * @return VehicleModelId
     */
    public function getId(): VehicleModelId
    {
        return $this->id;
    }

    /**
     * @return VehicleModelName
     */
    public function getName(): VehicleModelName
    {
        return $this->name;
    }

    /**
     * @return VehicleModelDeleted
     */
    public function getDeleted(): VehicleModelDeleted
    {
        return $this->deleted;
    }

    /**
     * @return VehicleBrandId
     */
    public function getIdBrand(): VehicleBrandId
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
    public function setBrand( ?VehicleBrand $brand ): void
    {
        $this->brand = $brand;
    }

    public static function createEntity( $request ): VehicleModel
    {
        return new self(
            new VehicleModelId($request->id),
            new VehicleModelName($request->name),
            new VehicleModelDeleted($request->deleted),
            new VehicleBrandId($request->id_vehicle_brand)
        );
    }

}
