<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\SimCard\Domain\Contracts\SimCardRepositoryContract;

final class GetCollectionTrashedByClientUseCase
{
    /**
     * @var SimCardRepositoryContract
     */
    private $repository;

    public function __construct(SimCardRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): array
    {
        $client = new ClientId($id);
        return $this->repository->collectionByClient($client);
    }
}
