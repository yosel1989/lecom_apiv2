<?php

declare(strict_types=1);

namespace Src\Admin\OperatorPhone\Application;

use Src\Admin\OperatorPhone\Domain\Contracts\OperatorPhoneRepositoryContract;

final class GetCollectionUseCase
{
    /**
     * @var OperatorPhoneRepositoryContract
     */
    private $repository;

    public function __construct(OperatorPhoneRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection();
    }
}
