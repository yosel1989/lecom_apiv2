<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketType\Domain;


use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeCode;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeId;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeType;

final class TicketType
{


    /**
     * @var TicketTypeId
     */
    private $id;
    /**
     * @var TicketTypeType
     */
    private $type;
    /**
     * @var TicketTypeCode
     */
    private $code;

    public function __construct(
        TicketTypeId $id,
        TicketTypeType $type,
        TicketTypeCode $code
    )
    {

        $this->id = $id;
        $this->type = $type;
        $this->code = $code;
    }

    /**
     * @return TicketTypeId
     */
    public function getId(): TicketTypeId
    {
        return $this->id;
    }

    /**
     * @return TicketTypeType
     */
    public function getType(): TicketTypeType
    {
        return $this->type;
    }

    /**
     * @return TicketTypeCode
     */
    public function getCode(): TicketTypeCode
    {
        return $this->code;
    }



    public static function create(
        TicketTypeId $id,
        TicketTypeType $type,
        TicketTypeCode $code
    ): TicketType
    {
        return new self( $id, $type, $code );
    }

    public static function createEntity( $response ): TicketType
    {
        return new self(
            new TicketTypeId( $response->id ),
            new TicketTypeType( $response->type ),
            new TicketTypeCode( $response->code )
        );
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'            => $this->getId()->value(),
            'type'      => $this->getType()->value(),
            'code'      => $this->getCode()->value(),
        ];
    }
}
