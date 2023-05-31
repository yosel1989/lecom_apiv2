<?php


namespace Src\Admin\Client\Application;

use Src\Admin\Client\Domain\Contracts\ClientRepositoryContract;

final class GetClientCollectionTrashUseCase
{
    private $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collectionTrash();
    }

}
