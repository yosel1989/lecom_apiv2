<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachine\Domain;


use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdClient;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdModel;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdStatus;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMImei;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMMaxFuel;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMSetPoint;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMSim;
use Src\Cold\ColdMachineHistory\Domain\ColdMachineHistory;
use Src\Cold\ColdMachineModel\Domain\ColdMachineModel;
use Src\Utility\UDateTime;

final class ColdMachine
{
    /**
     * @var CMId
     */
    private $id;
    /**
     * @var CMImei
     */
    private $imei;
    /**
     * @var CMIdModel
     */
    private $idModel;
    /**
     * @var CMIdStatus
     */
    private $idStatus;
    /**
     * @var CMSetPoint
     */
    private $setPoint;
    /**
     * @var CMIdClient
     */
    private $idClient;

    /**
     * @var ColdMachineModel
     */
    private $model;

    /**
     * @var CMSim
     */
    private $sim;
    /**
     * @var CMMaxFuel
     */
    private $maxFuel;
    /**
     * @var UserId
     */
    private $idUserCreated;
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
    * @var ColdMachineHistory | null
     */
    private $realTime = null;

    /**
     * ColdMachine constructor.
     * @param CMId $id
     * @param CMImei $imei
     * @param CMIdModel $idModel
     * @param CMIdStatus $idStatus
     * @param CMSetPoint $setPoint
     * @param CMIdClient $idClient
     * @param CMSim $sim
     * @param CMMaxFuel $maxFuel
     * @param UserId $idUserCreated
     * @param UserId|null $idUserUpdated
     */
    public function __construct(
        CMId  $id,
        CMImei $imei,
        CMIdModel $idModel,
        CMIdStatus $idStatus,
        CMSetPoint $setPoint,
        CMIdClient $idClient,
        CMSim $sim,
        CMMaxFuel $maxFuel,
        UserId $idUserCreated,
        ?UserId $idUserUpdated
    )
    {

        $this->id = $id;
        $this->imei = $imei;
        $this->idModel = $idModel;
        $this->idStatus = $idStatus;
        $this->setPoint = $setPoint;
        $this->idClient = $idClient;
        $this->sim = $sim;
        $this->maxFuel = $maxFuel;
        $this->idUserCreated = $idUserCreated;
        $this->idUserUpdated = $idUserUpdated;
    }

    /**
     * @return CMId
     */
    public function getId(): CMId
    {
        return $this->id;
    }

    /**
     * @return CMImei
     */
    public function getImei(): CMImei
    {
        return $this->imei;
    }

    /**
     * @return CMIdModel
     */
    public function getIdModel(): CMIdModel
    {
        return $this->idModel;
    }

    /**
     * @return CMIdStatus
     */
    public function getIdStatus(): CMIdStatus
    {
        return $this->idStatus;
    }

    /**
     * @return CMSetPoint
     */
    public function getSetPoint(): CMSetPoint
    {
        return $this->setPoint;
    }

    /**
     * @return CMIdClient
     */
    public function getIdClient(): CMIdClient
    {
        return $this->idClient;
    }

    /**
     * @return ColdMachineModel
     */
    public function getModel(): ColdMachineModel
    {
        return $this->model;
    }

    /**
     * @param ColdMachineModel $model
     */
    public function setModel(ColdMachineModel $model): void
    {
        $this->model = $model;
    }

    /**
     * @return CMSim
     */
    public function getSim(): CMSim
    {
        return $this->sim;
    }

    /**
     * @return CMMaxFuel
     */
    public function getMaxFuel(): CMMaxFuel
    {
        return $this->maxFuel;
    }

    /**
     * @return UserId
     */
    public function getIdUserCreated(): UserId
    {
        return $this->idUserCreated;
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
     * @return ColdMachineHistory|null
     */
    public function getRealTime(): ?ColdMachineHistory
    {
        return $this->realTime;
    }

    /**
     * @param ColdMachineHistory|null $realTime
     */
    public function setRealTime(?ColdMachineHistory $realTime): void
    {
        $this->realTime = $realTime;
    }




    public static function createEntity( $request ): ColdMachine
    {
        return new self(
            new CMId( $request->id ),
            new CMImei( $request->imei ),
            new CMIdModel( $request->id_model ),
            new CMIdStatus( $request->id_status ),
            new CMSetPoint( $request->setPoint ),
            new CMIdClient( $request->id_client ),
            new CMSim( $request->sim ),
            new CMMaxFuel( $request->maxFuel ),
            new UserId( $request->id_user_created ),
            $request->id_user_updated ? new UserId( $request->id_user_updated ) : null
        );
    }

}
