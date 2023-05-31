<?php


namespace Src\Admin\OperatorPhone\Domain\Contracts;


use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneId;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneName;
use Src\Admin\OperatorPhone\Domain\OperatorPhone;

interface OperatorPhoneRepositoryContract
{
    public function find( OperatorPhoneId $id ): ?OperatorPhone;

    public function create( OperatorPhoneId $id, OperatorPhoneName $name ): ?OperatorPhone;

    public function update( OperatorPhoneId $id, OperatorPhoneName $name ): ?OperatorPhone;

    public function trash( OperatorPhoneId $id ): void;

    public function delete( OperatorPhoneId $id ): void;

    public function restore( OperatorPhoneId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;
}
