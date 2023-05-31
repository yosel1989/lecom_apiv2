<?php


namespace Src\Cold\ColdMachineAlert\Domain\Contracts;


use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachineAlert\Domain\ColdMachineAlert;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMACode;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMADescription;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAId;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAText;

interface ColdMachineAlertRepositoryContract
{
    public function findByCode( CMACode $code ): ?ColdMachineAlert;

    public function create(
        CMAId  $id,
        CMACode $code,
        CMAText $text,
        CMADescription $description,
        UserId $idUserCreated
    ): ?ColdMachineAlert;

    public function update(
        CMAId  $id,
        CMACode $code,
        CMAText $text,
        CMADescription $description,
        UserId $idUserUpdated
    ): ?ColdMachineAlert;

    public function trash( CMAId $id ): void;

    public function delete( CMAId $id ): void;

    public function restore( CMAId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;
}
