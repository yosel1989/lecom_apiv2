<?php
declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class DestinoIdModel
{
    /**
     * @var string
     */
    private $idModel;

    /**
     * EmployeeIdClient constructor.
     * @param string $idModel
     */
    public function __construct( string $idModel = null )
    {
        $this->validate($idModel);
        $this->idModel = $idModel;
    }

    /**
     * @return string
     */
    public function value(): ?string
    {
        return $this->idModel;
    }

    /**
     * @param string $idModel
     */
    public function validate( string $idModel = null ): void
    {
        if ( !(is_null($idModel)) ){
            if( !Uuid::isValid($idModel) ){
                throw new InvalidArgumentException( 'Incorrect format Destino id client' . $idModel );
            }
        }
    }
}
