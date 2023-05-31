<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketPrice\Domain;


use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceActived;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceCode;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceDeleted;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceDistance;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceId;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceIdClient;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPricePrice;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeCode;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeId;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeType;

final class TicketPrice
{


    /**
     * @var TicketPriceId
     */
    private $id;
    /**
     * @var TicketPriceCode
     */
    private $code;
    /**
     * @var TicketPricePrice
     */
    private $price;
    /**
     * @var TicketPriceActived
     */
    private $actived;
    /**
     * @var TicketPriceDeleted
     */
    private $deleted;
    /**
     * @var TicketPriceIdClient
     */
    private $idClient;
    /**
     * @var TicketPriceDistance
     */
    private $distance;

    /**
     * TicketPrice constructor.
     * @param TicketPriceId $id
     * @param TicketPriceCode $code
     * @param TicketPricePrice $price
     * @param TicketPriceActived $actived
     * @param TicketPriceDeleted $deleted
     * @param TicketPriceIdClient $idClient
     * @param TicketPriceDistance $distance
     */
    public function __construct(
        TicketPriceId $id,
        TicketPriceCode $code,
        TicketPricePrice $price,
        TicketPriceActived $actived,
        TicketPriceDeleted $deleted,
        TicketPriceIdClient $idClient,
        TicketPriceDistance $distance
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->price = $price;
        $this->actived = $actived;
        $this->deleted = $deleted;
        $this->idClient = $idClient;
        $this->distance = $distance;
    }

    /**
     * @return TicketPriceId
     */
    public function getId(): TicketPriceId
    {
        return $this->id;
    }

    /**
     * @return TicketPriceCode
     */
    public function getCode(): TicketPriceCode
    {
        return $this->code;
    }

    /**
     * @return TicketPricePrice
     */
    public function getPrice(): TicketPricePrice
    {
        return $this->price;
    }

    /**
     * @return TicketPriceActived
     */
    public function getActived(): TicketPriceActived
    {
        return $this->actived;
    }

    /**
     * @return TicketPriceDeleted
     */
    public function getDeleted(): TicketPriceDeleted
    {
        return $this->deleted;
    }

    /**
     * @return TicketPriceIdClient
     */
    public function getIdClient(): TicketPriceIdClient
    {
        return $this->idClient;
    }

    /**
     * @return TicketPriceDistance
     */
    public function getDistance(): TicketPriceDistance
    {
        return $this->distance;
    }





    public static function create(
        TicketPriceId $id,
        TicketPriceCode $code,
        TicketPricePrice $price,
        TicketPriceActived $actived,
        TicketPriceDeleted $deleted,
        TicketPriceIdClient $idClient,
        TicketPriceDistance $distance
    ): TicketPrice
    {
        return new self( $id, $code, $price, $actived, $deleted, $idClient,$distance );
    }


    public static function createEntity( $request ): TicketPrice
    {
        return new self(
            new TicketPriceId($request->id),
            new TicketPriceCode($request->code),
            new TicketPricePrice($request->price),
            new TicketPriceActived($request->actived),
            new TicketPriceDeleted($request->deleted),
            new TicketPriceIdClient($request->id_client),
            new TicketPriceDistance($request->distance)
        );
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'            => $this->getId()->value(),
            'code'          => $this->getCode()->value(),
            'price'         => $this->getPrice()->value(),
            'actived'       => $this->getActived()->value(),
            'deleted'       => $this->getDeleted()->value(),
            'id_client'     => $this->getIdClient()->value(),
            'distance'     => $this->getDistance()->value(),
        ];
    }
}
