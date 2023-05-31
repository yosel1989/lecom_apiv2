<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineHistory\Application;

use Src\Cold\ColdMachineHistory\Domain\Contracts\ColdMachineHistoryRepositoryContract;

final class GetCollectionByFilterUseCase
{
    /**
     * @var ColdMachineHistoryRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineHistoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collectionByFilter();
    }
}
