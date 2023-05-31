<?php

declare(strict_types=1);

namespace Src\Admin\TypeInvoicing\Application;

use Src\Admin\TypeInvoicing\Domain\Contracts\TypeInvoicingRepositoryContract;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingId;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingMounths;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingName;
use Src\Admin\TypeInvoicing\Domain\TypeInvoicing;

final class CreateUseCase
{
    /**
     * @var TypeInvoicingRepositoryContract
     */
    private $repository;

    public function __construct(TypeInvoicingRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $name, int $mounths): ?TypeInvoicing
    {
        $g_id = new TypeInvoicingId($id);
        $g_name = new TypeInvoicingName($name);
        $g_mounths = new TypeInvoicingMounths($mounths);
        return $this->repository->create($g_id,$g_name,$g_mounths);
    }
}
