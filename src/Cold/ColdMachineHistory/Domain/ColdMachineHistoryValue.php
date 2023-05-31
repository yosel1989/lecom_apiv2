<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineHistory\Domain;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMImei;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHCo2;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHFrequencyOutput;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHHourmeter;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHHumidity;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHId;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLatitude;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLevelBattery;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLevelFuel;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLevelOutput;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLongitude;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHSpCo2;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHSpHumidity;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHSpTemperature;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHStatus;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHTemperatureMotor;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHTemperatureReturn;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHTemperatureSupply;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMCode;
use Src\Utility\UDateTime;

final class ColdMachineHistoryValue
{
    /**
     * @var CMHId
     */
    private $id;
    /**
     * @var CMMCode
     */
    private $type;
    /**
     * @var CMHStatus
     */
    private $status;
    /**
     * @var CMHLevelBattery
     */
    private $levelBattery;
    /**
     * @var CMHLevelOutput
     */
    private $levelOutput;
    /**
     * @var CMHFrequencyOutput
     */
    private $frequencyOutput;
    /**
     * @var CMHTemperatureMotor
     */
    private $temperatureMotor;
    /**
     * @var CMHHourmeter
     */
    private $hourmeter;
    /**
     * @var CMHTemperatureSupply
     */
    private $temperatureSupply;
    /**
     * @var CMHTemperatureReturn
     */
    private $temperatureReturn;
    /**
     * @var CMHHumidity
     */
    private $humidity;
    /**
     * @var CMHCo2
     */
    private $co2;
    /**
     * @var CMHSpTemperature
     */
    private $spTemperature;
    /**
     * @var CMHSpCo2
     */
    private $spCo2;
    /**
     * @var CMHSpHumidity
     */
    private $spHumidity;
    /**
     * @var ClientId
     */
    private $clientId;
    /**
     * @var UDateTime
     */
    private $createdAt;
    /**
     * @var CMHLevelFuel
     */
    private $levelFuel;
    /**
     * @var CMImei
     */
    private $imei;
    /**
     * @var CMId
     */
    private $idMachine;
    /**
     * @var CMHLatitude
     */
    private $latitude;
    /**
     * @var CMHLongitude
     */
    private $longitude;

    public function __construct(){}

    /**
     * @return CMHId
     */
    public function getId(): CMHId
    {
        return $this->id;
    }

    /**
     * @return CMMCode
     */
    public function getType(): CMMCode
    {
        return $this->type;
    }

    /**
     * @return CMHStatus
     */
    public function getStatus(): CMHStatus
    {
        return $this->status;
    }

    /**
     * @return CMHLevelBattery
     */
    public function getLevelBattery(): CMHLevelBattery
    {
        return $this->levelBattery;
    }

    /**
     * @return CMHLevelOutput
     */
    public function getLevelOutput(): CMHLevelOutput
    {
        return $this->levelOutput;
    }

    /**
     * @return CMHFrequencyOutput
     */
    public function getFrequencyOutput(): CMHFrequencyOutput
    {
        return $this->frequencyOutput;
    }

    /**
     * @return CMHTemperatureMotor
     */
    public function getTemperatureMotor(): CMHTemperatureMotor
    {
        return $this->temperatureMotor;
    }

    /**
     * @return CMHHourmeter
     */
    public function getHourmeter(): CMHHourmeter
    {
        return $this->hourmeter;
    }

    /**
     * @return CMHTemperatureSupply
     */
    public function getTemperatureSupply(): CMHTemperatureSupply
    {
        return $this->temperatureSupply;
    }

    /**
     * @return CMHTemperatureReturn
     */
    public function getTemperatureReturn(): CMHTemperatureReturn
    {
        return $this->temperatureReturn;
    }

    /**
     * @return CMHHumidity
     */
    public function getHumidity(): CMHHumidity
    {
        return $this->humidity;
    }

    /**
     * @return CMHLevelFuel
     */
    public function getLevelFuel(): CMHLevelFuel
    {
        return $this->levelFuel;
    }



    /**
     * @return CMHCo2
     */
    public function getCo2(): CMHCo2
    {
        return $this->co2;
    }

    /**
     * @return CMHSpTemperature
     */
    public function getSpTemperature(): CMHSpTemperature
    {
        return $this->spTemperature;
    }

    /**
     * @return CMHSpCo2
     */
    public function getSpCo2(): CMHSpCo2
    {
        return $this->spCo2;
    }

    /**
     * @return CMHSpHumidity
     */
    public function getSpHumidity(): CMHSpHumidity
    {
        return $this->spHumidity;
    }

    /**
     * @return ClientId
     */
    public function getClientId(): ClientId
    {
        return $this->clientId;
    }

    /**
     * @return UDateTime
     */
    public function getCreatedAt(): UDateTime
    {
        return $this->createdAt;
    }

    /**
     * @return CMImei
     */
    public function getImei(): CMImei
    {
        return $this->imei;
    }

    /**
     * @return CMId
     */
    public function getIdMachine(): CMId
    {
        return $this->idMachine;
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
     * @param CMHId $id
     */
    public function setId(CMHId $id): void
    {
        $this->id = $id;
    }

    /**
     * @param CMMCode $type
     */
    public function setType(CMMCode $type): void
    {
        $this->type = $type;
    }

    /**
     * @param CMHStatus $status
     */
    public function setStatus(CMHStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * @param CMHLevelBattery $levelBattery
     */
    public function setLevelBattery(CMHLevelBattery $levelBattery): void
    {
        $this->levelBattery = $levelBattery;
    }

    /**
     * @param CMHLevelOutput $levelOutput
     */
    public function setLevelOutput(CMHLevelOutput $levelOutput): void
    {
        $this->levelOutput = $levelOutput;
    }

    /**
     * @param CMHFrequencyOutput $frequencyOutput
     */
    public function setFrequencyOutput(CMHFrequencyOutput $frequencyOutput): void
    {
        $this->frequencyOutput = $frequencyOutput;
    }

    /**
     * @param CMHTemperatureMotor $temperatureMotor
     */
    public function setTemperatureMotor(CMHTemperatureMotor $temperatureMotor): void
    {
        $this->temperatureMotor = $temperatureMotor;
    }

    /**
     * @param CMHHourmeter $hourmeter
     */
    public function setHourmeter(CMHHourmeter $hourmeter): void
    {
        $this->hourmeter = $hourmeter;
    }

    /**
     * @param CMHTemperatureSupply $temperatureSupply
     */
    public function setTemperatureSupply(CMHTemperatureSupply $temperatureSupply): void
    {
        $this->temperatureSupply = $temperatureSupply;
    }

    /**
     * @param CMHTemperatureReturn $temperatureReturn
     */
    public function setTemperatureReturn(CMHTemperatureReturn $temperatureReturn): void
    {
        $this->temperatureReturn = $temperatureReturn;
    }

    /**
     * @param CMHHumidity $humidity
     */
    public function setHumidity(CMHHumidity $humidity): void
    {
        $this->humidity = $humidity;
    }

    /**
     * @param CMHCo2 $co2
     */
    public function setCo2(CMHCo2 $co2): void
    {
        $this->co2 = $co2;
    }

    /**
     * @param CMHSpTemperature $spTemperature
     */
    public function setSpTemperature(CMHSpTemperature $spTemperature): void
    {
        $this->spTemperature = $spTemperature;
    }

    /**
     * @param CMHSpCo2 $spCo2
     */
    public function setSpCo2(CMHSpCo2 $spCo2): void
    {
        $this->spCo2 = $spCo2;
    }

    /**
     * @param CMHSpHumidity $spHumidity
     */
    public function setSpHumidity(CMHSpHumidity $spHumidity): void
    {
        $this->spHumidity = $spHumidity;
    }

    /**
     * @param ClientId $clientId
     */
    public function setClientId(ClientId $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @param UDateTime $createdAt
     */
    public function setCreatedAt(UDateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param CMHLevelFuel $levelFuel
     */
    public function setLevelFuel(CMHLevelFuel $levelFuel): void
    {
        $this->levelFuel = $levelFuel;
    }

    /**
     * @param CMImei $imei
     */
    public function setImei(CMImei $imei): void
    {
        $this->imei = $imei;
    }

    /**
     * @param CMId $idMachine
     */
    public function setIdMachine(CMId $idMachine): void
    {
        $this->idMachine = $idMachine;
    }

    /**
     * @param CMHLatitude $latitude
     */
    public function setLatitude(CMHLatitude $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @param CMHLongitude $longitude
     */
    public function setLongitude(CMHLongitude $longitude): void
    {
        $this->longitude = $longitude;
    }



}
