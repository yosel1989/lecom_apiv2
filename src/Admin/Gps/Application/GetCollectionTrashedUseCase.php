<?php

declare(strict_types=1);

namespace Src\Admin\Gps\Application;

use Src\Admin\Gps\Domain\Contracts\GpsRepositoryContract;

final class GetCollectionTrashedUseCase
{
    /**
     * @var GpsRepositoryContract
     */
    private $repository;

    public function __construct(GpsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collectionTrashed();
    }
}
