<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineRealTime\Infrastructure\Repositories;

use App\Models\Cold\ColdMachineRealTime as EloquentColdMachineRealTimeModel;
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
use Src\Cold\ColdMachineRealTime\Domain\ColdMachineRealTime;
use Src\Cold\ColdMachineRealTime\Domain\Contracts\ColdMachineRealTimeRepositoryContract;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMCode;
use Src\Utility\UDateTime;

final class EloquentColdMachineRealTimeRepository implements ColdMachineRealTimeRepositoryContract
{
    /**
     * @var EloquentColdMachineRealTimeModel
     */
    private $EloquentColdMachineRealTimeModel;

    public function __construct()
    {
        $this->EloquentColdMachineRealTimeModel = new EloquentColdMachineRealTimeModel;
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
    ): void{

        $machine = $this->EloquentColdMachineRealTimeModel->where('imei',$imei->value())->first();
        if($machine){
            $this->EloquentColdMachineRealTimeModel->where('imei',$imei->value())->update([
                'type' => $type->value(),
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
        }else{
            $this->EloquentColdMachineRealTimeModel->create([
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
        }
    }

    public function collectionByClient(ClientId $idClient): array
    {
        $responseArray = $this->EloquentColdMachineRealTimeModel->where('id_client',$idClient->value())->get();
        $collection = array();

        foreach ( $responseArray as $response ){
            $OColdMachineRealTime = new ColdMachineRealTime(
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
            $collection[] = $OColdMachineRealTime;
        }

        return $collection;
    }

}
