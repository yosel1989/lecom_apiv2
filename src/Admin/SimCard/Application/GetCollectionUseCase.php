<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Application;

use Src\Admin\SimCard\Domain\Contracts\SimCardRepositoryContract;

final class GetCollectionUseCase
{
    /**
     * @var SimCardRepositoryContract
     */
    private $repository;

    public function __construct(SimCardRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection();
    }
}
