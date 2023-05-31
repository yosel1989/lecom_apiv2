<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class VehicleIdCategory
{
    /**
     * @var string
     */
    private $idCategory;

    /**
     * EmployeeIdClient constructor.
     * @param string|null $idCategory
     */
    public function __construct( ?string $idCategory )
    {
        $this->validate($idCategory);
        $this->idCategory = $idCategory;
    }

    /**
     * @return string
     */
    public function value(): ?string
    {
        return $this->idCategory;
    }

    /**
     * @param string|null $idCategory
     */
    public function validate( ?string $idCategory ): void
    {
        if (!(is_null($idCategory))){
            if( !Uuid::isValid($idCategory) ){
                throw new InvalidArgumentException( 'Incorrect format vehicle id category' . $idCategory );
            }
        }
    }
}
