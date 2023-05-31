<?php

declare(strict_types=1);

namespace Src\Admin\TypePay\Application;

use Src\Admin\TypePay\Domain\Contracts\TypePayRepositoryContract;

final class GetCollectionTrashedUseCase
{
    /**
     * @var TypePayRepositoryContract
     */
    private $repository;

    public function __construct(TypePayRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collectionTrashed();
    }
}
