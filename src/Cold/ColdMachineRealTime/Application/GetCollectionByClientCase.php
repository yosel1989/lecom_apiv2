<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineRealTime\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Cold\ColdMachineRealTime\Domain\Contracts\ColdMachineRealTimeRepositoryContract;

final class GetCollectionByClientCase
{
    /**
     * @var ColdMachineRealTimeRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineRealTimeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idClient): array
    {
        return $this->repository->collectionByClient(new ClientId($idClient));
    }
}
