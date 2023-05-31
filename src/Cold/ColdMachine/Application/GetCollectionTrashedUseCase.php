<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachine\Application;

use Src\Cold\ColdMachine\Domain\Contracts\ColdMachineRepositoryContract;

final class GetCollectionTrashedUseCase
{
    /**
     * @var ColdMachineRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collectionTrashed();
    }
}
