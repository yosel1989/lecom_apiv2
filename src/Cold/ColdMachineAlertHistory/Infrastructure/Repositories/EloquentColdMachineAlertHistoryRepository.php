<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlertHistory\Infrastructure\Repositories;

use App\Models\Cold\ColdMachineAlertHistory as EloquentColdMachineAlertHistoryModel;
use InvalidArgumentException;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachine\Domain\ColdMachine;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachineAlert\Domain\ColdMachineAlert;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAId;
use Src\Cold\ColdMachineAlertHistory\Domain\ColdMachineAlertHistory;
use Src\Cold\ColdMachineAlertHistory\Domain\Contracts\ColdMachineAlertHistoryRepositoryContract;
use Src\Cold\ColdMachineAlertHistory\Domain\ValueObjects\CMAHAttended;
use Src\Cold\ColdMachineAlertHistory\Domain\ValueObjects\CMAHId;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLatitude;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLongitude;
use Src\Utility\UDateTime;

final class EloquentColdMachineAlertHistoryRepository implements ColdMachineAlertHistoryRepositoryContract
{
    /**
     * @var EloquentColdMachineAlertHistoryModel
     */
    private $EloquentColdMachineAlertHistoryModel;

    public function __construct()
    {
        $this->EloquentColdMachineAlertHistoryModel = new EloquentColdMachineAlertHistoryModel;
    }

    public function create(
        CMAHId $id,
        CMAId $alertId,
        CMId $machineId,
        ClientId $clientId,
        CMHLatitude $latitude,
        CMHLongitude $longitude,
        UDateTime $createdAt
    ): ?ColdMachineAlertHistory{

        $response = $this->EloquentColdMachineAlertHistoryModel->create([
            'id' => $id->value(),
            'id_cold_machine_alert' => $alertId->value(),
            'id_cold_machine' => $machineId->value(),
            'id_client' => $clientId->value(),
            'latitude' => $latitude->value(),
            'longitude' => $longitude->value(),
            'created_at' => $createdAt->value()
        ]);
        $response = $this->EloquentColdMachineAlertHistoryModel->with(['alert','machine'])->findOrFail($id->value());

        $model = new ColdMachineAlertHistory(
            new CMAHId($response->id),
            new CMAId( $response->id_cold_machine_alert ),
            new CMId( $response->id_cold_machine ),
            new ClientId( $response->id_client ),
            new CMAHAttended( $response->attended ),
            new CMHLatitude( $response->latitude ),
            new CMHLongitude( $response->longitude ),
            $response->id_user_updated ? new UserId( $response->id_user_updated ) : null,
            new UDateTime( $response->created_at )
        );
        $model->setAlert( is_null($response->alert) ? null : ColdMachineAlert::createEntity($response->alert) );
        $model->setMachine( is_null($response->machine) ? null : ColdMachine::createEntity($response->machine) );
        return $model;
    }

    public function update(
        CMAHId $id,
        UserId $userIdd
    ): void{
        $today = new \DateTime('now');
        $this->EloquentColdMachineAlertHistoryModel->findOrFail($id->value())->update([
            'attended' => 1,
            'id_user_updated' => $userIdd->value(),
            'updated_at' => $today->format('Y-m-d H:i:s')
        ]);
    }

    public function collectionByClient(
        ClientId $idClient,
        UDateTime $dateStart,
        UDateTime $dateEnd
    ): array{

        $dS = new \DateTime($dateStart->value());
        $dE = new \DateTime($dateEnd->value());
        $responseArray = $this->EloquentColdMachineAlertHistoryModel
            ->with(['alert','machine'])
            ->whereDate('created_at', '>=', $dS->format('Y-m-d'))
            ->whereDate('created_at', '<=', $dE->format('Y-m-d'))
            ->where('id_client',$idClient->value())
            ->get();
        $collection = array();

        foreach ( $responseArray as $response ){
            $OColdMachineAlertHistory = new ColdMachineAlertHistory(
                new CMAHId($response->id),
                new CMAId( $response->id_cold_machine_alert ),
                new CMId( $response->id_cold_machine ),
                new ClientId( $response->id_client ),
                new CMAHAttended( $response->attended ),
                new CMHLatitude( $response->latitude ),
                new CMHLongitude( $response->longitude ),
                $response->id_user_updated ? new UserId( $response->id_user_updated ) : null,
                new UDateTime( $response->created_at )
            );
            $OColdMachineAlertHistory->setAlert( is_null($response->alert) ? null : ColdMachineAlert::createEntity($response->alert) );
            $OColdMachineAlertHistory->setMachine( is_null($response->machine) ? null : ColdMachine::createEntity($response->machine) );
            $collection[] = $OColdMachineAlertHistory;
        }

        return $collection;
    }

    public function lastByClient(
        ClientId $idClient
    ): array{

        $now = new \DateTime('now');

        $responseArray = $this->EloquentColdMachineAlertHistoryModel
            ->with('alert','machine')
            ->whereDate('created_at', '<=', $now->format('Y-m-d'))
            ->where('id_client',$idClient->value())
            ->limit(4)
            ->orderBy('created_at','desc')
            ->get();
        $collection = array();

        foreach ( $responseArray as $response ){
            $OColdMachineAlertHistory = new ColdMachineAlertHistory(
                new CMAHId($response->id),
                new CMAId( $response->id_cold_machine_alert ),
                new CMId( $response->id_cold_machine ),
                new ClientId( $response->id_client ),
                new CMAHAttended( $response->attended ),
                new CMHLatitude( $response->latitude ),
                new CMHLongitude( $response->longitude ),
                $response->id_user_updated ? new UserId( $response->id_user_updated ) : null,
                new UDateTime( $response->created_at )
            );
            $OColdMachineAlertHistory->setAlert( is_null($response->alert) ? null : ColdMachineAlert::createEntity($response->alert) );
            $OColdMachineAlertHistory->setMachine( is_null($response->machine) ? null : ColdMachine::createEntity($response->machine) );
            $collection[] = $OColdMachineAlertHistory;
        }

        return $collection;
    }

    public function countByClient(ClientId $idClient): int
    {
        $now = new \DateTime('now');

        $output = $this->EloquentColdMachineAlertHistoryModel
            ->where('id_client',$idClient->value())
            ->where('attended',0)
            ->count();

        return $output;
    }

}
