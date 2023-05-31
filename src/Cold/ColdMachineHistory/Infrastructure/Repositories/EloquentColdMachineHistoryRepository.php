<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineHistory\Infrastructure\Repositories;

use App\Models\Cold\ColdMachineHistory as EloquentColdMachineHistoryModel;
use InvalidArgumentException;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMImei;
use Src\Cold\ColdMachineHistory\Domain\ColdMachineHistory;
use Src\Cold\ColdMachineHistory\Domain\ColdMachineHistoryValue;
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

final class EloquentColdMachineHistoryRepository implements ColdMachineHistoryRepositoryContract
{
    /**
     * @var EloquentColdMachineHistoryModel
     */
    private $EloquentColdMachineHistoryModel;

    public function __construct()
    {
        $this->EloquentColdMachineHistoryModel = new EloquentColdMachineHistoryModel;
    }

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
    ): ?ColdMachineHistory{
        $this->EloquentColdMachineHistoryModel->create([
            'id' => $id->value(),
            'type' => $type->value(),
            'imei' => $imei->value(),
            'id_cold_machine' => $idMachine->value(),
            'status' => $status->value(),
            'level_battery' => $levelBattery->value(),
            'level_fuel' => $levelFuel->value(),
            'level_output' => $levelOutput->value(),
            'frequency_output' => $frequencyOutput->value(),
            'temperature_motor' => $temperatureMotor->value(),
            'hourmeter' => $hourmeter->value(),
            'temperature_supply' => $temperatureSupply->value(),
            'temperature_return' => $temperatureReturn->value(),
            'humidity' => $humidity->value(),
            'co2' => $co2->value(),
            'sp_temperature' => $spTemperature->value(),
            'sp_co2' => $spCo2->value(),
            'sp_humidity' => $spHumidity->value(),
            'id_client' => $clientId->value(),
            'latitude' => $latitude->value(),
            'longitude' => $longitude->value(),
            'created_at' => $createdAt->value()
        ]);

        $response = $this->EloquentColdMachineHistoryModel->findOrFail($id->value());
        $OColdMachineHistory = new ColdMachineHistory(
            new CMHId( $response->id ),
            new CMMCode( $response->type ),
            new CMImei( $response->imei ),
            new CMId( $response->id_cold_machine ),
            new CMHStatus( $response->status ),
            new CMHLevelFuel( $response->level_fuel ),
            new CMHLevelBattery( $response->level_battery ),
            new CMHLevelOutput( $response->level_output ),
            new CMHFrequencyOutput( $response->frequency_output ),
            new CMHTemperatureMotor( $response->temperature_motor ),
            new CMHHourmeter( $response->hourmeter ),
            new CMHTemperatureSupply( $response->temperature_supply ),
            new CMHTemperatureReturn( $response->temperature_return ),
            new CMHHumidity( $response->humidity ),
            new CMHCo2( $response->co2 ),
            new CMHSpTemperature( $response->sp_temperature ),
            new CMHSpCo2( $response->sp_co2 ),
            new CMHSpHumidity( $response->sp_humidity ),
            new ClientId( $response->id_client ),
            new CMHLatitude( $response->latitude ),
            new CMHLongitude( $response->longitude ),
            new UDateTime( $response->created_at )
        );
        return $OColdMachineHistory;
    }

    public function collectionByFilter(): array
    {
        $responseArray = $this->EloquentColdMachineHistoryModel->all();
        $collection = array();

        foreach ( $responseArray as $response ){
            $OColdMachineHistory = new ColdMachineHistory(
                new CMHId( $response->id ),
                new CMMCode( $response->type ),
                new CMImei( $response->imei ),
                new CMId( $response->id_cold_machine ),
                new CMHStatus( $response->status ),
                new CMHLevelFuel( $response->level_fuel ),
                new CMHLevelBattery( $response->level_battery ),
                new CMHLevelOutput( $response->level_output ),
                new CMHFrequencyOutput( $response->frequency_output ),
                new CMHTemperatureMotor( $response->temperature_motor ),
                new CMHHourmeter( $response->hourmeter ),
                new CMHTemperatureSupply( $response->temperature_supply ),
                new CMHTemperatureReturn( $response->temperature_return ),
                new CMHHumidity( $response->humidity ),
                new CMHCo2( $response->co2 ),
                new CMHSpTemperature( $response->sp_temperature ),
                new CMHSpCo2( $response->sp_co2 ),
                new CMHSpHumidity( $response->sp_humidity ),
                new ClientId( $response->id_client ),
                new CMHLatitude( $response->latitude ),
                new CMHLongitude( $response->longitude ),
                new UDateTime( $response->created_at )
            );
            $collection[] = $OColdMachineHistory;
        }

        return $collection;
    }


    public function historyLevelFuel(UDateTime $dateStart, UDateTime $dateEnd, CMImei $imei): array
    {
        $dS = new \DateTime($dateStart->value());
        $dE = new \DateTime($dateEnd->value());
        $response = $this->EloquentColdMachineHistoryModel
            ->select(
                'id',
                'level_fuel',
                'created_at',
                'latitude',
                'longitude'
            )
            ->where('imei', $imei->value())
            ->whereDate('created_at', '>=', $dS->format('Y-m-d'))
            ->whereDate('created_at', '<=', $dE->format('Y-m-d'))
            ->get();
        $collection = array();

        foreach ($response as $res) {

                $model = new ColdMachineHistoryValue();
                $model->setId(new CMHId( $res->id ));
                $model->setLevelFuel(new CMHLevelFuel( $res->level_fuel ));
                $model->setCreatedAt(new UDateTime( $res->created_at ));
                $model->setLatitude(new CMHLatitude( $res->latitude ));
                $model->setLongitude(new CMHLongitude( $res->longitude ));

                $collection[] = $model;

        }

        return $collection;
    }

    public function historyLevelOutput(UDateTime $dateStart, UDateTime $dateEnd, CMImei $imei): array
    {
        $dS = new \DateTime($dateStart->value());
        $dE = new \DateTime($dateEnd->value());
        $response = $this->EloquentColdMachineHistoryModel
            ->select(
                'id',
                'level_output',
                'created_at',
                'latitude',
                'longitude'
            )
            ->where('imei', $imei->value())
            ->whereDate('created_at', '>=', $dS->format('Y-m-d'))
            ->whereDate('created_at', '<=', $dE->format('Y-m-d'))
            ->get();
        $collection = array();

        foreach ($response as $res) {

            $model = new ColdMachineHistoryValue();
            $model->setId(new CMHId( $res->id ));
            $model->setLevelOutput(new CMHLevelOutput( $res->level_output ));
            $model->setCreatedAt(new UDateTime( $res->created_at ));
            $model->setLatitude(new CMHLatitude( $res->latitude ));
            $model->setLongitude(new CMHLongitude( $res->longitude ));

            $collection[] = $model;

        }

        return $collection;
    }

    public function historyTemperatureMotor(UDateTime $dateStart, UDateTime $dateEnd, CMImei $imei): array
    {
        $dS = new \DateTime($dateStart->value());
        $dE = new \DateTime($dateEnd->value());
        $response = $this->EloquentColdMachineHistoryModel
            ->select(
                'id',
                'temperature_motor',
                'created_at',
                'latitude',
                'longitude'
            )
            ->where('imei', $imei->value())
            ->whereDate('created_at', '>=', $dS->format('Y-m-d'))
            ->whereDate('created_at', '<=', $dE->format('Y-m-d'))
            ->get();
        $collection = array();

        foreach ($response as $res) {

            $model = new ColdMachineHistoryValue();
            $model->setId(new CMHId( $res->id ));
            $model->setTemperatureMotor(new CMHTemperatureMotor( $res->temperature_motor ));
            $model->setCreatedAt(new UDateTime( $res->created_at ));
            $model->setLatitude(new CMHLatitude( $res->latitude ));
            $model->setLongitude(new CMHLongitude( $res->longitude ));

            $collection[] = $model;

        }

        return $collection;
    }
}
