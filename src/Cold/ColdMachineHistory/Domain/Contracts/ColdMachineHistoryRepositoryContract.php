<?php


namespace Src\Cold\ColdMachineHistory\Domain\Contracts;


use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMImei;
use Src\Cold\ColdMachineHistory\Domain\ColdMachineHistory;
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

interface ColdMachineHistoryRepositoryContract
{

    public function create(
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
        CMHLatitude $latitude,
        CMHLongitude $longitude,
        UDateTime $createdAt
    ): ?ColdMachineHistory;

    public function collectionByFilter(): array;

    public function historyLevelFuel(UDateTime $dateStart, UDateTime $dateEnd, CMImei $imei): array;

    public function historyLevelOutput(UDateTime $dateStart, UDateTime $dateEnd, CMImei $imei): array;

    public function historyTemperatureMotor(UDateTime $dateStart, UDateTime $dateEnd, CMImei $imei): array;

}
