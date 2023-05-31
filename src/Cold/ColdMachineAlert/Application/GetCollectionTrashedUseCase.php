<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlert\Application;

use Src\Cold\ColdMachineAlert\Domain\Contracts\ColdMachineAlertRepositoryContract;

final class GetCollectionTrashedUseCase
{
    /**
     * @var ColdMachineAlertRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineAlertRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collectionTrashed();
    }
}
