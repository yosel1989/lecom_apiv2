<?php


namespace Src\Cold\ColdMachineModel\Domain\Contracts;


use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachineModel\Domain\ColdMachineModel;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMCode;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMId;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMIdType;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMName;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMShortName;

interface ColdMachineModelRepositoryContract
{
    public function find( CMMId $id ): ?ColdMachineModel;

    public function create(
        CMMId $id,
        CMMName $name,
        CMMShortName $shortName,
        CMMIdType $idType,
        CMMCode $code,
        UserId $idUserCreated
    ): ?ColdMachineModel;

    public function update(
        CMMId $id,
        CMMName $name,
        CMMShortName $shortName,
        CMMIdType $idType,
        CMMCode $code,
        UserId $idUserUpdated
    ): ?ColdMachineModel;

    public function trash( CMMId $id ): void;

    public function delete( CMMId $id ): void;

    public function restore( CMMId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;
}
