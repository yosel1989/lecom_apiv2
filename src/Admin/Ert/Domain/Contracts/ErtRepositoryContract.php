<?php


namespace Src\Admin\Ert\Domain\Contracts;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Ert\Domain\Ert;
use Src\Admin\Ert\Domain\ValueObjects\ErtId;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdGps;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdSim;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdType;
use Src\Admin\Ert\Domain\ValueObjects\ErtPeriod;
use Src\Admin\Ert\Domain\ValueObjects\ErtSutran;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;

interface ErtRepositoryContract
{
    public function create(
        ErtId $id,
        ErtPeriod $period,
        ErtSutran $sutran,
        ClientId $clientId,
        VehicleId $vehicleId,
        ErtIdType $idType,
        ErtIdGps $idGps,
        ErtIdSim $idSim
    );

    public function update(
        ErtId $id,
        ErtPeriod $period,
        ErtSutran $sutran,
        VehicleId $vehicleId,
        ErtIdType $idType,
        ErtIdGps $idGps,
        ErtIdSim $idSim
    ): ?Ert;
    public function trash( ErtId $id ): void;
    public function delete( ErtId $id ): void;
    public function restore( ErtId $id ): void;
    public function collectionByClient(ClientId $idClient): array;
    public function updateSutran( ErtId $id, ErtSutran $sutran ): void;
}
