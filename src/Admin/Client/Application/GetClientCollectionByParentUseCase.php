<?php


namespace Src\Admin\Client\Application;


use Src\Admin\Client\Domain\Contracts\ClientRepositoryContract;
use Src\Admin\Client\Domain\ValueObjects\ClientIdParent;

final class GetClientCollectionByParentUseCase
{
    private $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idParent ): array
    {
        return $this->repository->collectionByParent(
            new ClientIdParent($idParent)
        );
    }

}
