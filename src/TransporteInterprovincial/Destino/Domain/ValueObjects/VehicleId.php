<?php

declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class DestinoId
{
    /**
     * @var string
     */
    private $id;

    /**
     * EmployeeId constructor.
     * @param string $id
     */
    public function __construct(string $id )
    {
        $this->validation($id);
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function value() : string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    private function validation( string $id ): void
    {
        if( !Uuid::isValid($id) ){
            throw new InvalidArgumentException( 'Incorrect format  Destino id ' . $id );
        }
    }

}
