<?php

declare(strict_types=1);

namespace Src\General\Vehicle\Domain\ValueObjects;

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
     * @param string $idCategory
     */
    public function __construct( string $idCategory = null )
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
     * @param string $idCategory
     */
    public function validate( string $idCategory = null ): void
    {
        if (!(is_null($idCategory))){
            if( !Uuid::isValid($idCategory) ){
                throw new InvalidArgumentException( 'Incorrect format vehicle id client' . $idCategory );
            }
        }
    }
}
