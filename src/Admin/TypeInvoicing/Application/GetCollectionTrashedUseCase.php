<?php

declare(strict_types=1);

namespace Src\Admin\TypeInvoicing\Application;

use Src\Admin\TypeInvoicing\Domain\Contracts\TypeInvoicingRepositoryContract;

final class GetCollectionTrashedUseCase
{
    /**
     * @var TypeInvoicingRepositoryContract
     */
    private $repository;

    public function __construct(TypeInvoicingRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collectionTrashed();
    }
}
