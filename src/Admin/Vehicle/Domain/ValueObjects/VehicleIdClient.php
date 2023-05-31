<?php
declare(strict_types=1);

namespace Src\Admin\Vehicle\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class VehicleIdClient
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
            throw new InvalidArgumentException( 'Incorrect format vehicle id client' . $idClient );
        }
    }
}
