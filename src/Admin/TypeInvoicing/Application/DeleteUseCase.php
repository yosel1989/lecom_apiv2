<?php

declare(strict_types=1);

namespace Src\Admin\TypeInvoicing\Application;

use Src\Admin\TypeInvoicing\Domain\Contracts\TypeInvoicingRepositoryContract;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingId;

final class DeleteUseCase
{
    /**
     * @var TypeInvoicingRepositoryContract
     */
    private $repository;

    public function __construct(TypeInvoicingRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $g_id = new TypeInvoicingId($value);
                $this->repository->delete($g_id);
            }

        }else{

            $g_id = new TypeInvoicingId($id);
            $this->repository->delete($g_id);

        }

    }
}
