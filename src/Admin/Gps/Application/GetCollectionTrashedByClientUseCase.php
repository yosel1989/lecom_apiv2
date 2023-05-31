<?php

declare(strict_types=1);

namespace Src\Admin\Gps\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Gps\Domain\Contracts\GpsRepositoryContract;

final class GetCollectionTrashedByClientUseCase
{
    /**
     * @var GpsRepositoryContract
     */
    private $repository;

    public function __construct(GpsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): array
    {
        $client = new ClientId($id);
        return $this->repository->collectionByClient($client);
    }
}
