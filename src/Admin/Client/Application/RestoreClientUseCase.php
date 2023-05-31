<?php


namespace Src\Admin\Client\Application;

use Src\Admin\Client\Domain\Contracts\ClientRepositoryContract;
use Src\Admin\Client\Domain\ValueObjects\ClientId;

final class RestoreClientUseCase
{
    private $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        $this->repository->restore( new ClientId($id) );
    }

}
