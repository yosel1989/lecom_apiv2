<?php


namespace Src\Cold\ColdMachine\Domain\Contracts;


use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachine\Domain\ColdMachine;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdClient;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdModel;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdStatus;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMImei;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMMaxFuel;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMSetPoint;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMSim;

interface ColdMachineRepositoryContract
{
    public function find( CMId $id ): ?ColdMachine;

    public function create(
        CMId  $id,
        CMImei $imei,
        CMIdModel $idModel,
        CMIdStatus $idStatus,
        CMSetPoint $setPoint,
        CMIdClient $idClient,
        CMMaxFuel $maxFuel,
        CMSim $sim,
        UserId $idUser
    ): ?ColdMachine;

    public function update(
        CMId  $id,
        CMImei $imei,
        CMIdModel $idModel,
        CMIdStatus $idStatus,
        CMSetPoint $setPoint,
        CMIdClient $idClient,
        CMMaxFuel $maxFuel,
        CMSim $sim,
        UserId $idUser
    ): ?ColdMachine;

    public function findByImei(
        CMImei $imei
    ): ?ColdMachine;

    public function trash( CMId $id ): void;

    public function delete( CMId $id ): void;

    public function restore( CMId $id ): void;

    public function collection(): array;

    public function collectionByClient( ClientId $clientId ): array;

    public function realTimeByClient( ClientId $clientId ): array;

    public function collectionTrashed(): array;
}
