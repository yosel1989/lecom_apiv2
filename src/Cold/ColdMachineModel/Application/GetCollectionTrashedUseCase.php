<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineModel\Application;

use Src\Cold\ColdMachineModel\Domain\Contracts\ColdMachineModelRepositoryContract;

final class GetCollectionTrashedUseCase
{
    /**
     * @var ColdMachineModelRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineModelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collectionTrashed();
    }
}
