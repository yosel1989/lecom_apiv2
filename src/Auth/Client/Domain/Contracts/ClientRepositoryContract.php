<?php


namespace Src\Auth\Client\Domain\Contracts;


use Src\Auth\Client\Domain\Client;
use Src\Auth\Client\Domain\ValueObjects\ClientId;

interface ClientRepositoryContract
{
    public function find(ClientId $id): ?Client;

    public function save(Client $client): void;

    public function update(ClientId $clientId, Client $client): void;

    public function delete(ClientId $id): void;

}
