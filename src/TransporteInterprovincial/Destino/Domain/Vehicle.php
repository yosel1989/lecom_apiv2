<?php
declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Domain;

use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdBrand;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdFleet;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoDeleted;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoId;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdCategory;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdClass;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdClient;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdModel;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoPlate;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoUnit;
use Src\TransporteInterprovincial\DestinoBrand\Domain\DestinoBrand;
use Src\TransporteInterprovincial\DestinoClass\Domain\DestinoClass;
use Src\TransporteInterprovincial\DestinoFleet\Domain\DestinoFleet;
use Src\TransporteInterprovincial\DestinoModel\Domain\DestinoModel;

final class Destino
{
    /**
     * @var DestinoId
     */
    private $id;
    /**
     * @var DestinoPlate
     */
    private $plate;
    /**
     * @var DestinoUnit
     */
    private $unit;
    /**
     * @var DestinoDeleted
     */
    private $deleted;
    /**
     * @var DestinoIdClient
     */
    private $idClient;
    /**
     * @var DestinoIdCategory
     */
    private $idCategory;
    /**
     * @var DestinoIdModel
     */
    private $idModel;
    /**
     * @var DestinoIdClass
     */
    private $idClass;
    /**
     * @var DestinoIdFleet
     */
    private $idFleet;
    /**
     * @var DestinoBrand | null
     */
    private $brand;
    /**
     * @var DestinoModel | null
     */
    private $model;
    /**
     * @var DestinoClass | null
     */
    private $class;
    /**
     * @var DestinoFleet | null
     */
    private $fleet;
    /**
     * @var DestinoIdBrand
     */
    private $idBrand;

    /**
     * Destino constructor.
     * @param DestinoId $id
     * @param DestinoPlate $plate
     * @param DestinoUnit $unit
     * @param DestinoDeleted $deleted
     * @param DestinoIdClient $idClient
     * @param DestinoIdCategory $idCategory
     * @param DestinoIdModel $idModel
     * @param DestinoIdClass $idClass
     * @param DestinoIdFleet $idFleet
     * @param DestinoIdBrand $idBrand
     */
    public function __construct(
        DestinoId $id,
        DestinoPlate $plate,
        DestinoUnit $unit,
        DestinoDeleted $deleted,
        DestinoIdClient $idClient,
        DestinoIdCategory $idCategory,
        DestinoIdModel $idModel,
        DestinoIdClass $idClass,
        DestinoIdFleet $idFleet,
        DestinoIdBrand $idBrand
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
     * @return DestinoId
     */
    public function getId(): DestinoId
    {
        return $this->id;
    }

    /**
     * @return DestinoPlate
     */
    public function getPlate(): DestinoPlate
    {
        return $this->plate;
    }

    /**
     * @return DestinoUnit
     */
    public function getUnit(): DestinoUnit
    {
        return $this->unit;
    }

    /**
     * @return DestinoDeleted
     */
    public function getDeleted(): DestinoDeleted
    {
        return $this->deleted;
    }

    /**
     * @return DestinoIdClient
     */
    public function getIdClient(): DestinoIdClient
    {
        return $this->idClient;
    }

    /**
     * @return DestinoIdCategory
     */
    public function getIdCategory(): DestinoIdCategory
    {
        return $this->idCategory;
    }

    /**
     * @return DestinoIdModel
     */
    public function getIdModel(): DestinoIdModel
    {
        return $this->idModel;
    }

    /**
     * @return DestinoIdClass
     */
    public function getIdClass(): DestinoIdClass
    {
        return $this->idClass;
    }

    /**
     * @return DestinoIdFleet
     */
    public function getIdFleet(): DestinoIdFleet
    {
        return $this->idFleet;
    }

    /**
     * @return DestinoIdBrand
     */
    public function getIdBrand(): DestinoIdBrand
    {
        return $this->idBrand;
    }



    /**
     * @return DestinoBrand|null
     */
    public function getBrand(): ?DestinoBrand
    {
        return $this->brand;
    }

    /**
     * @param DestinoBrand|null $brand
     */
    public function setBrand(?DestinoBrand $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return DestinoModel|null
     */
    public function getModel(): ?DestinoModel
    {
        return $this->model;
    }

    /**
     * @param DestinoModel|null $model
     */
    public function setModel(?DestinoModel $model): void
    {
        $this->model = $model;
    }

    /**
     * @return DestinoClass|null
     */
    public function getClass(): ?DestinoClass
    {
        return $this->class;
    }

    /**
     * @param DestinoClass|null $class
     */
    public function setClass(?DestinoClass $class): void
    {
        $this->class = $class;
    }

    /**
     * @return DestinoFleet|null
     */
    public function getFleet(): ?DestinoFleet
    {
        return $this->fleet;
    }

    /**
     * @param DestinoFleet|null $fleet
     */
    public function setFleet(?DestinoFleet $fleet): void
    {
        $this->fleet = $fleet;
    }





    public static function createEntity( $request ): Destino
    {
        return new self(
            new DestinoId($request->id),
            new DestinoPlate($request->plate),
            new DestinoUnit($request->unit),
            new DestinoDeleted($request->deleted),
            new DestinoIdClient($request->id_client),
            new DestinoIdCategory($request->id_category),
            new DestinoIdModel($request->id_model),
            new DestinoIdClass($request->id_class),
            new DestinoIdFleet($request->id_fleet),
            new DestinoIdBrand($request->id_brand)
        );
    }

    /**
     * @param array $DestinoArray
     * @return array
     */
    public static function getIdList(array $DestinoArray  ): array{
        $arrId = [];
        foreach( $DestinoArray as $Destino ){
            $arrId[] = $Destino->getId()->value();
        }
        return $arrId;
    }
}
