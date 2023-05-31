<?php

declare(strict_types=1);

namespace Src\Auth\User\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class UserId
{
    /**
     * @var string
     */
    private $id;

    public function __construct(string $id )
    {
        $this->validate( $id );
        $this->id = $id;
    }

    /**
     * @param string id
     */
    private function validate(string $id): void
    {
        if( !Uuid::isValid($id) ){
            throw new InvalidArgumentException( 'Does not allow the invalid format id');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->id;
    }
}
