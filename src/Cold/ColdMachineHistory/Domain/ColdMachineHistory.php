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

final class ColdMachineHistory
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

    /**
     * ColdMachineHistory constructor.
     * @param CMHId $id
     * @param CMMCode $type
     * @param CMImei $imei
     * @param CMId $idMachine
     * @param CMHStatus $status
     * @param CMHLevelFuel $levelFuel
     * @param CMHLevelBattery $levelBattery
     * @param CMHLevelOutput $levelOutput
     * @param CMHFrequencyOutput $frequencyOutput
     * @param CMHTemperatureMotor $temperatureMotor
     * @param CMHHourmeter $hourmeter
     * @param CMHTemperatureSupply $temperatureSupply
     * @param CMHTemperatureReturn $temperatureReturn
     * @param CMHHumidity $humidity
     * @param CMHCo2 $co2
     * @param CMHSpTemperature $spTemperature
     * @param CMHSpCo2 $spCo2
     * @param CMHSpHumidity $spHumidity
     * @param CMHLatitude $latitude
     * @param CMHLongitude $longitude
     * @param ClientId $clientId
     * @param UDateTime $createdAt
     */
    public function __construct(
        CMHId  $id,
        CMMCode $type,
        CMImei $imei,
        CMId $idMachine,
        CMHStatus $status,
        CMHLevelFuel $levelFuel,
        CMHLevelBattery $levelBattery,
        CMHLevelOutput $levelOutput,
        CMHFrequencyOutput $frequencyOutput,
        CMHTemperatureMotor $temperatureMotor,
        CMHHourmeter $hourmeter,
        CMHTemperatureSupply $temperatureSupply,
        CMHTemperatureReturn $temperatureReturn,
        CMHHumidity $humidity,
        CMHCo2 $co2,
        CMHSpTemperature $spTemperature,
        CMHSpCo2 $spCo2,
        CMHSpHumidity $spHumidity,
        ClientId $clientId,
        CMHLatitude  $latitude,
        CMHLongitude $longitude,
        UDateTime $createdAt
    )
    {

        $this->id = $id;
        $this->type = $type;
        $this->status = $status;
        $this->levelBattery = $levelBattery;
        $this->levelOutput = $levelOutput;
        $this->frequencyOutput = $frequencyOutput;
        $this->temperatureMotor = $temperatureMotor;
        $this->hourmeter = $hourmeter;
        $this->temperatureSupply = $temperatureSupply;
        $this->temperatureReturn = $temperatureReturn;
        $this->humidity = $humidity;
        $this->co2 = $co2;
        $this->spTemperature = $spTemperature;
        $this->spCo2 = $spCo2;
        $this->spHumidity = $spHumidity;
        $this->clientId = $clientId;
        $this->createdAt = $createdAt;
        $this->levelFuel = $levelFuel;
        $this->imei = $imei;
        $this->idMachine = $idMachine;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

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



    public static function createEntity( $request ): ColdMachineHistory
    {
        return new self(
            new CMHId( $request->id ),
            new CMMCode( $request->type ),
            new CMImei( $request->imei ),
            new CMId( $request->id_cold_machine ),
            new CMHStatus( $request->status ),
            new CMHLevelFuel( $request->level_fuel ),
            new CMHLevelBattery( $request->level_battery ),
            new CMHLevelOutput( $request->level_output ),
            new CMHFrequencyOutput( $request->frequency_output ),
            new CMHTemperatureMotor( $request->temperature_motor ),
            new CMHHourmeter( $request->hourmeter ),
            new CMHTemperatureSupply( $request->temperature_supply ),
            new CMHTemperatureReturn( $request->temperature_return ),
            new CMHHumidity( $request->humidity ),
            new CMHCo2( $request->co2 ),
            new CMHSpTemperature( $request->sp_temperature ),
            new CMHSpCo2( $request->sp_co2 ),
            new CMHSpHumidity( $request->sp_humidity ),
            new ClientId( $request->id_client ),
            new CMHLatitude( $request->latitude ),
            new CMHLongitude( $request->longitude ),
            new UDateTime( $request->created_at )
        );
    }

    public function toArray(): array
    {
        return [
            'id'    => $this->getId()->value(),
            'type'  => $this->getType()->value(),
            'imei'  => $this->getImei()->value(),
            'idMachine'  => $this->getIdMachine()->value(),
            'status'  => $this->getStatus()->value(),
            'levelBattery' => $this->getLevelBattery()->value(),
            'levelFuel' => $this->getLevelFuel()->value(),
            'levelOutput' => $this->getLevelOutput()->value(),
            'frequencyOutput' => $this->getFrequencyOutput()->value(),
            'temperatureMotor' => $this->getTemperatureMotor()->value(),
            'hourmeter' => $this->getHourmeter()->value(),
            'temeperatureSupply' => $this->getTemperatureSupply()->value(),
            'temperatureReturn' => $this->getTemperatureReturn()->value(),
            'humididty' => $this->getHumidity()->value(),
            'co2' => $this->getCo2()->value(),
            'spTemperature' => $this->getSpTemperature()->value(),
            'spCo2' => $this->getSpCo2()->value(),
            'spHumidity' => $this->getSpHumidity()->value(),
            'idClient' => $this->getClientId()->value(),
            'latitude' => $this->getLatitude()->value(),
            'longitude' => $this->getLongitude()->value(),
            'createdAt' => $this->getCreatedAt()->value()
        ];
    }
}
