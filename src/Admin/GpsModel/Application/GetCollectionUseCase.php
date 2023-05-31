<?php

declare(strict_types=1);

namespace Src\Admin\GpsModel\Application;

use Src\Admin\GpsModel\Domain\Contracts\GpsModelRepositoryContract;

final class GetCollectionUseCase
{
    /**
     * @var GpsModelRepositoryContract
     */
    private $repository;

    public function __construct(GpsModelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection();
    }
}
