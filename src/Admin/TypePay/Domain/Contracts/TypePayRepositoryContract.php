<?php

namespace Src\Admin\TypePay\Domain\Contracts;

use Src\Admin\TypePay\Domain\ValueObjects\TypePayAmount;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayCurrency;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayDescription;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayId;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayName;
use Src\Admin\TypePay\Domain\TypePay;

interface TypePayRepositoryContract
{
    public function find( TypePayId $id ): ?TypePay;

    public function create(
        TypePayId $id,
        TypePayName $name,
        TypePayDescription $description,
        TypePayCurrency $currency,
        TypePayAmount $amount
    ): ?TypePay;

    public function update(
        TypePayId $id,
        TypePayName $name,
        TypePayDescription $description,
        TypePayCurrency $currency,
        TypePayAmount $amount
    ): ?TypePay;

    public function trash( TypePayId $id ): void;

    public function delete( TypePayId $id ): void;

    public function restore( TypePayId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;
}
