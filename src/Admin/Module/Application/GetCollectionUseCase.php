<?php

declare(strict_types=1);

namespace Src\Admin\Module\Application;

use Src\Admin\Module\Domain\Contracts\ModuleRepositoryContract;

final class GetCollectionUseCase
{
    /**
     * @var ModuleRepositoryContract
     */
    private $repository;

    public function __construct(ModuleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection();
    }
}
