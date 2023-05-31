<?php


namespace Src\Cold\ColdMachineAlertHistory\Domain\Contracts;


use App\Models\Auth\Client;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAId;
use Src\Cold\ColdMachineAlertHistory\Domain\ColdMachineAlertHistory;
use Src\Cold\ColdMachineAlertHistory\Domain\ValueObjects\CMAHId;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLatitude;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLongitude;
use Src\Utility\UDateTime;

interface ColdMachineAlertHistoryRepositoryContract
{

    public function create(
        CMAHId $id,
        CMAId $alertId,
        CMId $machineId,
        ClientId $clientId,
        CMHLatitude $latitude,
        CMHLongitude $longitude,
        UDateTime $createdAt
    ): ?ColdMachineAlertHistory;

    public function update(
        CMAHId $id,
        UserId $idUser
    ): void;

    public function collectionByClient(ClientId $idClient, UDateTime $dateStart, UDateTime $dateEnd): array;

    public function lastByClient(ClientId $idClient): array;

    public function countByClient(ClientId $idClient): int;

}
