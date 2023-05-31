<?php
declare(strict_types=1);

namespace Src\General\Vehicle\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class VehicleIdClass
{
    /**
     * @var string
     */
    private $idClass;

    /**
     * EmployeeIdClient constructor.
     * @param string $idClass
     */
    public function __construct( string $idClass = null )
    {
        $this->validate($idClass);
        $this->idClass = $idClass;
    }

    /**
     * @return string
     */
    public function value(): ?string
    {
        return $this->idClass;
    }

    /**
     * @param string $idClass
     */
    public function validate( string $idClass = null ): void
    {
        if(!is_null($idClass)){
            if( !Uuid::isValid($idClass) ){
                throw new InvalidArgumentException( 'Incorrect format vehicle id client' . $idClass );
            }
        }
    }
}
