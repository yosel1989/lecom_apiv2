<?php

declare(strict_types=1);

namespace Src\Admin\VehicleClass\Domain;


use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassDeleted;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassIcon;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassId;
use Src\Admin\VehicleClass\Domain\ValueObjects\VehicleClassName;

final class VehicleClass
{
    /**
     * @var VehicleClassId
     */
    private $id;
    /**
     * @var VehicleClassName
     */
    private $name;
    /**
     * @var VehicleClassIcon
     */
    private $icon;
    /**
     * @var VehicleClassDeleted
     */
    private $deleted;

    /**
     * VehicleClass constructor.
     * @param VehicleClassId $id
     * @param VehicleClassName $name
     * @param VehicleClassIcon $icon
     * @param VehicleClassDeleted $deleted
     */
    public function __construct(
        VehicleClassId  $id,
        VehicleClassName $name,
        VehicleClassIcon $icon,
        VehicleClassDeleted $deleted
    )
    {

        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
        $this->deleted = $deleted;
    }

    /**
     * @return VehicleClassId
     */
    public function getId(): VehicleClassId
    {
        return $this->id;
    }

    /**
     * @return VehicleClassName
     */
    public function getName(): VehicleClassName
    {
        return $this->name;
    }

    /**
     * @return VehicleClassIcon
     */
    public function getIcon(): VehicleClassIcon
    {
        return $this->icon;
    }

    /**
     * @return VehicleClassDeleted
     */
    public function getDeleted(): VehicleClassDeleted
    {
        return $this->deleted;
    }

    public static function createEntity( $request ): VehicleClass
    {
        return new self(
            new VehicleClassId ( $request->id ),
            new VehicleClassName( $request->name ),
            new VehicleClassIcon( $request->icon ),
            new VehicleClassDeleted( $request->deleted )
        );
    }

}
