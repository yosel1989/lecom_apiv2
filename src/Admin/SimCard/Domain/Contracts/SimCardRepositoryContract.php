<?php


namespace Src\Admin\SimCard\Domain\Contracts;


use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneId;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardDetail;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardImei;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardNumber;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardId;
use Src\Admin\SimCard\Domain\SimCard;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardStatus;

interface SimCardRepositoryContract
{
    public function find( SimCardId $id ): ?SimCard;

    public function create( SimCardId $id, SimCardNumber $number, SimCardImei $imei, SimCardDetail $detail, SimCardStatus $status, OperatorPhoneId $idOperator, ClientId $clientId ): ?SimCard;

    public function update( SimCardId $id, SimCardNumber $number, SimCardImei $imei, SimCardDetail $detail, OperatorPhoneId $idOperator ): ?SimCard;

    public function trash( SimCardId $id ): void;

    public function delete( SimCardId $id ): void;

    public function restore( SimCardId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;

    public function collectionByOperator( OperatorPhoneId $idOperator ): array;

    public function collectionByClient( ClientId $clientId ): array;

    public function collectionTrashedByClient( ClientId $clientId ): array;
}
