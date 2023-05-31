<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain;



use Src\Auth\Client\Domain\Client;
use Src\General\Vehicle\Domain\Vehicle;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketCode;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketCount;
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
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPricePrice;
use Src\VehicleTicketing\TicketType\Domain\TicketType;

final class TicketProduction
{

    /**
     * @var null|Client
     */
    private $client;
    /**
     * @var null|Vehicle
     */
    private $vehicle;
    /**
     * @var TicketDate
     */
    private $date;
    /**
     * @var TicketTurn
     */
    private $turn;
    /**
     * @var TicketIdClient
     */
    private $idClient;
    /**
     * @var TicketIdVehicle
     */
    private $idVehicle;
    /**
     * @var TicketPricePrice
     */
    private $total;
    /**
     * @var null|TicketType
     */
    private $type;
    /**
     * @var TicketCount
     */
    private $count;


    /**
     * Ticket constructor.
     * @param TicketDate $date
     * @param TicketTurn $turn
     * @param TicketIdClient $idClient
     * @param TicketIdVehicle $idVehicle
     * @param TicketPricePrice $total
     * @param TicketCount $count
     */
    public function __construct(
        TicketDate $date,
        TicketTurn $turn,
        TicketIdClient $idClient,
        TicketIdVehicle $idVehicle,
        TicketPricePrice $total,
        TicketCount $count
    )
    {
        $this->date = $date;
        $this->turn = $turn;
        $this->idClient = $idClient;
        $this->idVehicle = $idVehicle;
        $this->total = $total;
        $this->client = null;
        $this->vehicle = null;
        $this->count = $count;
    }

    /**
     * @return TicketDate
     */
    public function getDate(): TicketDate
    {
        return $this->date;
    }

    /**
     * @return TicketTurn
     */
    public function getTurn(): TicketTurn
    {
        return $this->turn;
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
     * @return TicketPricePrice
     */
    public function getTotal(): TicketPricePrice
    {
        return $this->total;
    }

    /**
     * @return TicketCount
     */
    public function getCount(): TicketCount
    {
        return $this->count;
    }



    /**
     * @return Client|null
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



}
