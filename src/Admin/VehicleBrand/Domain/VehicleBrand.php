<?php

declare(strict_types=1);

namespace Src\Admin\VehicleBrand\Domain;


use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandDeleted;
use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandId;
use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandName;

final class VehicleBrand
{
    /**
     * @var VehicleBrandId
     */
    private $id;
    /**
     * @var VehicleBrandName
     */
    private $name;
    /**
     * @var VehicleBrandDeleted
     */
    private $deleted;

    /**
     * VehicleBrand constructor.
     * @param VehicleBrandId $id
     * @param VehicleBrandName $name
     * @param VehicleBrandDeleted $deleted
     */
    public function __construct(
        VehicleBrandId  $id,
        VehicleBrandName $name,
        VehicleBrandDeleted $deleted
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->deleted = $deleted;
    }

    /**
     * @return VehicleBrandId
     */
    public function getId(): VehicleBrandId
    {
        return $this->id;
    }

    /**
     * @return VehicleBrandName
     */
    public function getName(): VehicleBrandName
    {
        return $this->name;
    }

    /**
     * @return VehicleBrandDeleted
     */
    public function getDeleted(): VehicleBrandDeleted
    {
        return $this->deleted;
    }


    public static function createEntity( $request ): VehicleBrand
    {
        return new self(
            new VehicleBrandId ($request->id),
            new VehicleBrandName($request->name),
            new VehicleBrandDeleted($request->deleted)
        );
    }

}
