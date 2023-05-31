<?php

declare(strict_types=1);

namespace Src\Auth\Client\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class ClientIdParentClient
{
    /**
     * @var string
     */
    private $idParentClient;

    public function __construct( string $idParentClient )
    {
        $this->validate( $idParentClient );
        $this->idParentClient = $idParentClient;
    }

    /**
     * @param string $idParentClient
     */
    private function validate( string $idParentClient = null ): void
    {
        if ( !is_null($idParentClient) ){
            if( !Uuid::isValid($idParentClient) ){
                throw new InvalidArgumentException( 'Does not allow the invalid format id parent client');
            }
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->idParentClient;
    }
}
