<?php

namespace Src\Admin\GpsModel\Domain\Contracts;

use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelId;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelInput;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelName;
use Src\Admin\GpsModel\Domain\GpsModel;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelOutput;

interface GpsModelRepositoryContract
{
    public function find( GpsModelId $id ): ?GpsModel;

    public function create( GpsModelId $id, GpsModelName $name, GpsModelInput $input, GpsModelOutput $output ): ?GpsModel;

    public function update( GpsModelId $id, GpsModelName $name, GpsModelInput $input, GpsModelOutput $output ): ?GpsModel;

    public function trash( GpsModelId $id ): void;

    public function delete( GpsModelId $id ): void;

    public function restore( GpsModelId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;
}
