<?php
declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class DestinoIdClient
{
    /**
     * @var string
     */
    private $idClient;

    /**
     * EmployeeIdClient constructor.
     * @param string $idClient
     */
    public function __construct(string $idClient )
    {
        $this->validate($idClient);
        $this->idClient = $idClient;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->idClient;
    }

    /**
     * @param string $idClient
     */
    public function validate(string $idClient): void
    {
        if( !Uuid::isValid($idClient) ){
            throw new InvalidArgumentException( 'Incorrect format Destino id client' . $idClient );
        }
    }
}
