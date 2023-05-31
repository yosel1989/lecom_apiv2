<?php


namespace Src\Admin\User\Application;


use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\User\Domain\Contracts\UserRepositoryContract;


final class GetUserCollectionTrashByClientUseCase
{
    private $repository;

    public function __construct( UserRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idClient ): array
    {
        return $this->repository->collectionTrashByClient(
            new ClientId( $idClient )
        );
    }

}
