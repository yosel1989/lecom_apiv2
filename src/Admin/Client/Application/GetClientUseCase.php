<?php


namespace Src\Admin\Client\Application;


use Src\Admin\Client\Domain\Contracts\ClientRepositoryContract;
use Src\Admin\Client\Domain\Client;
use Src\Admin\Client\Domain\ValueObjects\ClientId;

final class GetClientUseCase
{
    private $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $ClientId): ?Client
    {
        $id = new ClientId($ClientId);
        return $this->repository->find($id);
    }
}
