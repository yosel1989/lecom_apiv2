<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain;



use Src\Auth\Client\Domain\Client;
use Src\General\Vehicle\Domain\Vehicle;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketCode;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketDate;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketDeleted;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketId;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdClient;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdMachine;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdPrice;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdType;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketLatitude;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketLongitude;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketTurn;
use Src\VehicleTicketing\TicketMachine\Domain\TicketMachine;
use Src\VehicleTicketing\TicketPrice\Domain\TicketPrice;
use Src\VehicleTicketing\TicketType\Domain\TicketType;

final class Ticket
{

    /**
     * @var TicketId
     */
    private $id;
    /**
     * @var TicketCode
     */
    private $code;
    /**
     * @var TicketDate
     */
    private $date;
    /**
     * @var TicketLatitude
     */
    private $latitude;
    /**
     * @var TicketLongitude
     */
    private $longitude;
    /**
     * @var TicketDeleted
     */
    private $deleted;
    /**
     * @var TicketIdClient
     */
    private $idClient;
    /**
     * @var TicketIdVehicle
     */
    private $idVehicle;
    /**
     * @var TicketIdMachine
     */
    private $idMachine;
    /**
     * @var TicketIdPrice
     */
    private $idPrice;
    /**
     * @var TicketIdType
     */
    private $idType;
    /**
     * @var TicketTurn
     */
    private $turn;
    /**
     * @var null|Client
     */
    private $client;
    /**
     * @var null|Vehicle
     */
    private $vehicle;
    /**
     * @var null|TicketPrice
     */
    private $price;
    /**
     * @var null|TicketMachine
     */
    private $machine;
    /**
     * @var null|TicketType
     */
    private $type;
    /**
     * @var DateOnlyFormat
     */
    private $reserved;


    /**
     * Ticket constructor.
     * @param TicketId $id
     * @param TicketCode $code
     * @param TicketDate $date
     * @param TicketLatitude $latitude
     * @param TicketLongitude $longitude
     * @param TicketTurn $turn
     * @param TicketDeleted $deleted
     * @param TicketIdClient $idClient
     * @param TicketIdVehicle $idVehicle
     * @param TicketIdMachine $idMachine
     * @param TicketIdPrice $idPrice
     * @param TicketIdType $idType
     */
    public function __construct(
        TicketId $id,
        TicketCode $code,
        TicketDate $date,
        TicketLatitude $latitude,
        TicketLongitude $longitude,
        TicketTurn $turn,
        TicketDeleted $deleted,
        TicketIdClient $idClient,
        TicketIdVehicle $idVehicle,
        TicketIdMachine $idMachine,
        TicketIdPrice $idPrice,
        TicketIdType $idType
    )
    {

        $this->id = $id;
        $this->code = $code;
        $this->date = $date;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->deleted = $deleted;
        $this->idClient = $idClient;
        $this->idVehicle = $idVehicle;
        $this->idMachine = $idMachine;
        $this->idPrice = $idPrice;
        $this->idType = $idType;
        $this->turn = $turn;
        $this->client = null;
        $this->vehicle = null;
        $this->price = null;
        $this->machine = null;
        $this->type = null;
    }


    /**
     * @return TicketId
     */
    public function getId(): TicketId
    {
        return $this->id;
    }

    /**
     * @return TicketCode
     */
    public function getCode(): TicketCode
    {
        return $this->code;
    }

    /**
     * @return TicketDate
     */
    public function getDate(): TicketDate
    {
        return $this->date;
    }

    /**
     * @return TicketLatitude
     */
    public function getLatitude(): TicketLatitude
    {
        return $this->latitude;
    }

    /**
     * @return TicketLongitude
     */
    public function getLongitude(): TicketLongitude
    {
        return $this->longitude;
    }

    /**
     * @return TicketTurn
     */
    public function getTurn(): TicketTurn
    {
        return $this->turn;
    }

    /**
     * @return TicketDeleted
     */
    public function getDeleted(): TicketDeleted
    {
        return $this->deleted;
    }

    /**
     * @return TicketIdClient
     */
    public function getIdClient(): TicketIdClient
    {
        return $this->idClient;
    }

    /**
     * @return TicketIdVehicle
     */
    public function getIdVehicle(): TicketIdVehicle
    {
        return $this->idVehicle;
    }

    /**
     * @return TicketIdMachine
     */
    public function getIdMachine(): TicketIdMachine
    {
        return $this->idMachine;
    }

    /**
     * @return TicketIdPrice
     */
    public function getIdPrice(): TicketIdPrice
    {
        return $this->idPrice;
    }

    /**
     * @return TicketIdType
     */
    public function getIdType(): TicketIdType
    {
        return $this->idType;
    }

    /**
     * @return Client
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }

    /**
     * @param Client|null $client
     */
    public function setClient(?Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return Vehicle|null
     */
    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    /**
     * @param Vehicle|null $vehicle
     */
    public function setVehicle(?Vehicle $vehicle): void
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @return TicketPrice|null
     */
    public function getPrice(): ?TicketPrice
    {
        return $this->price;
    }

    /**
     * @param TicketPrice|null $price
     */
    public function setPrice(?TicketPrice $price): void
    {
        $this->price = $price;
    }

    /**
     * @return TicketMachine|null
     */
    public function getMachine(): ?TicketMachine
    {
        return $this->machine;
    }

    /**
     * @param TicketMachine|null $machine
     */
    public function setMachine(?TicketMachine $machine): void
    {
        $this->machine = $machine;
    }

    /**
     * @return TicketType|null
     */
    public function getType(): ?TicketType
    {
        return $this->type;
    }

    /**
     * @param TicketType|null $type
     */
    public function setType(?TicketType $type): void
    {
        $this->type = $type;
    }


    public function today() {
        return $this->where('brand', 'brand.id' , '=', 'brandtop.brand_id');
    }

    /**
     * @return DateOnlyFormat
     */
    public function getReserved(): DateOnlyFormat
    {
        return $this->reserved;
    }

    /**
     * @param DateOnlyFormat $reserved
     */
    public function setReserved(DateOnlyFormat $reserved): void
    {
        $this->reserved = $reserved;
    }





    /**
     * @param TicketId $id
     * @param TicketCode $code
     * @param TicketDate $date
     * @param TicketLatitude $latitude
     * @param TicketLongitude $longitude
     * @param TicketDeleted $deleted
     * @param TicketTurn $turn
     * @param TicketIdClient $idClient
     * @param TicketIdVehicle $idVehicle
     * @param TicketIdMachine $idMachine
     * @param TicketIdPrice $idPrice
     * @param TicketIdType $idType
     * @return Ticket
     */
    public static function create(
        TicketId $id,
        TicketCode $code,
        TicketDate $date,
        TicketLatitude $latitude,
        TicketLongitude $longitude,
        TicketTurn $turn,
        TicketDeleted $deleted,
        TicketIdClient $idClient,
        TicketIdVehicle $idVehicle,
        TicketIdMachine $idMachine,
        TicketIdPrice $idPrice,
        TicketIdType $idType
    ): Ticket
    {
        return new self( $id, $code, $date, $latitude, $longitude, $turn, $deleted, $idClient, $idVehicle, $idMachine, $idPrice, $idType );
    }


    public static function createEntity( $request ): Ticket
    {
        return new self(
            new TicketId($request->id),
            new TicketCode($request->code),
            new TicketDate($request->date),
            new TicketLatitude($request->latitude),
            new TicketLongitude($request->longitude),
            new TicketTurn($request->turn),
            new TicketDeleted($request->deleted),
            new TicketIdClient($request->id_client),
            new TicketIdVehicle($request->id_vehicle),
            new TicketIdMachine($request->id_ticket_machine),
            new TicketIdPrice($request->id_ticket_price),
            new TicketIdType($request->id_ticket_type)
        );
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'            => $this->getId()->value(),
            'code'      => $this->getCode()->value(),
            'date'      => $this->getDate()->value(),
            'latitude'    => $this->getLatitude()->value(),
            'longitude'     => $this->getLongitude()->value(),
            'turn'         => $this->getTurn()->value(),
            'deleted'         => $this->getDeleted()->value(),
            'id_client'         => $this->getIdClient()->value(),
            'id_vehicle'      => $this->getIdClient()->value(),
            'id_ticket_machine'       => $this->getIdMachine()->value(),
            'id_ticket_price'       => $this->getIdPrice()->value(),
            'id_ticket_type'     => $this->getIdType()->value(),
        ];
    }



    /**
     * @param Ticket|null $lastTicketToday
     * @param TicketCode $ticketCode
     * @return int
     */
    static function calculeTurn( ?Ticket $lastTicketToday , TicketCode $ticketCode ): int
    {
        if ( is_null($lastTicketToday) ){
            return 1;
        }

        if( ((int)$ticketCode->value()) === 1 ){
            return $lastTicketToday->getTurn()->value()+1;
        }

        if( ((int)$ticketCode->value()) > 1 ){
            return $lastTicketToday->getTurn()->value();
        }

        return 1;
    }

    static function filterTicketsCollectionByDefeated( array $tickets, TicketLatitude $latitude, TicketLongitude $longitude) : array
    {
        return array_map( function( $ticket ) use ($latitude,$longitude){
            $price = $ticket->getPrice();

            if( \Map::distanceBetweenPoints($latitude->value(),$longitude->value(),$ticket->getLatitude()->value(),$ticket->getLongitude()->value(),"K") > $price->getDistance()->value() ){
                return $ticket;
            }
            return false;
        }, $tickets );

    }

}
