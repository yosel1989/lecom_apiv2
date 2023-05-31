<?php


namespace Src\Admin\Client\Application;

use Src\Admin\Client\Domain\Contracts\ClientRepositoryContract;
use Src\Admin\Client\Domain\ValueObjects\ClientId;

final class DeleteClientUseCase
{
    private $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        $this->repository->delete( new ClientId($id) );
    }

}
