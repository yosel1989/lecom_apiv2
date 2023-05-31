<?php

namespace Src\Admin\Gps\Domain\Contracts;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Gps\Domain\ValueObjects\GpsId;
use Src\Admin\Gps\Domain\ValueObjects\GpsIdModel;
use Src\Admin\Gps\Domain\ValueObjects\GpsImei;
use Src\Admin\Gps\Domain\Gps;
use Src\Admin\Gps\Domain\ValueObjects\GpsType;

interface GpsRepositoryContract
{
    public function find( GpsId $id ): ?Gps;

    public function create( GpsId $id, GpsImei $imei,  GpsIdModel $idModel, GpsType $type, ClientId $clientId): ?Gps;

    public function update( GpsId $id, GpsImei $imei,  GpsIdModel $idModel, GpsType $type ): ?Gps;

    public function trash( GpsId $id ): void;

    public function delete( GpsId $id ): void;

    public function restore( GpsId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;

    public function collectionByClient( ClientId $clientId ): array;

    public function collectionTrashedByClient( ClientId $clientId ): array;

}
