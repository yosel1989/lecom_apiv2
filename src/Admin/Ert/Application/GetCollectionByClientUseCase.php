<?php

declare(strict_types=1);

namespace Src\Admin\Ert\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Ert\Domain\Contracts\ErtRepositoryContract;

final class GetCollectionByClientUseCase
{
    /**
     * @var ErtRepositoryContract
     */
    private $repository;

    public function __construct(ErtRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idClient): array
    {
        $id_client = new ClientId($idClient);
        return $this->repository->collectionByClient($id_client);
    }
}
