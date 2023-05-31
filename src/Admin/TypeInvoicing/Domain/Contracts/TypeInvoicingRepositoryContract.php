<?php

namespace Src\Admin\TypeInvoicing\Domain\Contracts;

use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingId;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingMounths;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingName;
use Src\Admin\TypeInvoicing\Domain\TypeInvoicing;

interface TypeInvoicingRepositoryContract
{
    public function find( TypeInvoicingId $id ): ?TypeInvoicing;

    public function create( TypeInvoicingId $id, TypeInvoicingName $name, TypeInvoicingMounths $mounths ): ?TypeInvoicing;

    public function update( TypeInvoicingId $id, TypeInvoicingName $name, TypeInvoicingMounths $mounths ): ?TypeInvoicing;

    public function trash( TypeInvoicingId $id ): void;

    public function delete( TypeInvoicingId $id ): void;

    public function restore( TypeInvoicingId $id ): void;

    public function collection(): array;

    public function collectionTrashed(): array;
}
