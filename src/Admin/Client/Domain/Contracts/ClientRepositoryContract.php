<?php


namespace Src\Admin\Client\Domain\Contracts;


use Src\Admin\Client\Domain\ValueObjects\ClientAddress;
use Src\Admin\Client\Domain\ValueObjects\ClientBussinessName;
use Src\Admin\Client\Domain\ValueObjects\ClientDni;
use Src\Admin\Client\Domain\ValueObjects\ClientEmail;
use Src\Admin\Client\Domain\ValueObjects\ClientFirstName;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Client\Domain\ValueObjects\ClientIdParent;
use Src\Admin\Client\Domain\ValueObjects\ClientLastName;
use Src\Admin\Client\Domain\ValueObjects\ClientPhone;
use Src\Admin\Client\Domain\ValueObjects\ClientRuc;
use Src\Admin\Client\Domain\ValueObjects\ClientType;
use Src\Admin\Client\Domain\Client;

interface ClientRepositoryContract
{
    public function create(
        ClientId $id,
        ClientBussinessName $bussinessName,
        ClientFirstName $firstName,
        ClientLastName $lastName,
        ClientRuc $ruc,
        ClientDni $dni,
        ClientEmail $email,
        ClientAddress $address,
        ClientPhone $phone,
        ClientType $type,
        ClientIdParent $idParent
    ): ?Client;

    public function update(
        ClientId $id,
        ClientBussinessName $bussinessName,
        ClientFirstName $firstName,
        ClientLastName $lastName,
        ClientRuc $ruc,
        ClientDni $dni,
        ClientEmail $email,
        ClientAddress $address,
        ClientPhone $phone,
        ClientType $type
    ): ?Client;

    public function find( ClientId $id ): ?Client;

    public function trash( ClientId $id ): void;

    public function delete( ClientId $id ): void;

    public function restore( ClientId $id ): void;

    public function collection( ): array;

    public function collectionTrash( ): array;

    public function collectionByParent( ClientIdParent $idParent ): array;

    public function collectionTrashByParent( ClientIdParent $idParent ): array;
}
