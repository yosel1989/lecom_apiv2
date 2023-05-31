<?php

declare(strict_types=1);

namespace Src\Admin\TypeInvoicing\Domain;

use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingDeleted;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingId;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingMounths;
use Src\Admin\TypeInvoicing\Domain\ValueObjects\TypeInvoicingName;

final class TypeInvoicing
{
    /**
     * @var TypeInvoicingId
     */
    private $id;
    /**
     * @var TypeInvoicingName
     */
    private $name;
    /**
     * @var TypeInvoicingMounths
     */
    private $mounths;
    /**
     * @var TypeInvoicingDeleted
     */
    private $deleted;

    /**
     * TypeInvoicing constructor.
     * @param TypeInvoicingId $id
     * @param TypeInvoicingName $name
     * @param TypeInvoicingMounths $mounths
     * @param TypeInvoicingDeleted $deleted
     */
    public function __construct(
        TypeInvoicingId  $id,
        TypeInvoicingName $name,
        TypeInvoicingMounths $mounths,
        TypeInvoicingDeleted $deleted
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->mounths = $mounths;
        $this->deleted = $deleted;
    }

    /**
     * @return TypeInvoicingId
     */
    public function getId(): TypeInvoicingId
    {
        return $this->id;
    }

    /**
     * @return TypeInvoicingName
     */
    public function getName(): TypeInvoicingName
    {
        return $this->name;
    }

    /**
     * @return TypeInvoicingMounths
     */
    public function getMounths(): TypeInvoicingMounths
    {
        return $this->mounths;
    }

    /**
     * @return TypeInvoicingDeleted
     */
    public function getDeleted(): TypeInvoicingDeleted
    {
        return $this->deleted;
    }


    public static function createEntity( $request ): TypeInvoicing
    {
        return new self(
            new TypeInvoicingId ($request->id),
            new TypeInvoicingName($request->name),
            new TypeInvoicingMounths($request->mounths),
            new TypeInvoicingDeleted($request->deleted)
        );
    }

}
