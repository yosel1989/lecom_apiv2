<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineHistory\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMImei;
use Src\Cold\ColdMachineHistory\Domain\ColdMachineHistory;
use Src\Cold\ColdMachineHistory\Domain\Contracts\ColdMachineHistoryRepositoryContract;
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

final class CreateUseCase
{
    /**
     * @var ColdMachineHistoryRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineHistoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        int $type,
        string $imei,
        string $idMachine,
        ?int $status,
        ?float $levelFuel,
        ?float $levelBattery,
        ?float $levelOutput,
        ?float $frequencyOutput,
        ?float $temperatureMotor,
        ?int $hourmeter,
        ?float $temperatureSupply,
        ?float $temperatureReturn,
        ?float $humidity,
        ?int $co2,
        ?int $spTemperature,
        ?int $spCo2,
        ?int $spHumidity,
        string $clientId,
        float $latitude,
        float $longitude,
        string $createdAt
    ): ?ColdMachineHistory
    {
        return $this->repository->create(
            new CMHId($id),
            new CMMCode($type),
            new CMImei($imei),
            new CMId($idMachine),
            new CMHStatus($status),
            new CMHLevelFuel($levelFuel),
            new CMHLevelBattery($levelBattery),
            new CMHLevelOutput($levelOutput),
            new CMHFrequencyOutput($frequencyOutput),
            new CMHTemperatureMotor($temperatureMotor),
            new CMHHourmeter($hourmeter),
            new CMHTemperatureSupply($temperatureSupply),
            new CMHTemperatureReturn($temperatureReturn),
            new CMHHumidity($humidity),
            new CMHCo2($co2),
            new CMHSpTemperature($spTemperature),
            new CMHSpCo2($spCo2),
            new CMHSpHumidity($spHumidity),
            new ClientId($clientId),
            new CMHLatitude($latitude),
            new CMHLongitude($longitude),
            new UDateTime($createdAt)
        );
    }
}
