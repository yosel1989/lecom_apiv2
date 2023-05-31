<?php


namespace Src\VehicleTicketing\TicketPrice\Infraestructure\Repositories;


use App\Models\VehicleTicketing\TicketPrice as EloquentTicketPriceModel;
use Src\VehicleTicketing\TicketPrice\Domain\Contracts\TicketPriceRepositoryContract;
use Src\VehicleTicketing\TicketPrice\Domain\TicketPrice;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceActived;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceCode;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceDeleted;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceDistance;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceId;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceIdClient;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPricePrice;

final class EloquentTicketPriceRepository implements TicketPriceRepositoryContract
{
    /**
     * @var EloquentTicketPriceModel
     */
    private $eloquentTicketPriceModel;

    public function __construct()
    {
        $this->eloquentTicketPriceModel = new EloquentTicketPriceModel;
    }

    public function find(TicketPriceId $id): ?TicketPrice
    {

        $ticketPrice = $this->eloquentTicketPriceModel->where('actived', 1)->findOrFail($id->value());

        // Return Domain Ticket model
        return new TicketPrice(
            new TicketPriceId($ticketPrice->id),
            new TicketPriceCode($ticketPrice->code),
            new TicketPricePrice($ticketPrice->price),
            new TicketPriceActived($ticketPrice->actived),
            new TicketPriceDeleted($ticketPrice->deleted),
            new TicketPriceIdClient($ticketPrice->id_client),
            new TicketPriceDistance($ticketPrice->distance)
        );

    }

    public function findByCriteria( TicketPriceCode $code , TicketPriceIdClient $idClient ): ?TicketPrice
    {
        $ticketPrice = $this->eloquentTicketPriceModel
            ->where('code', $code->value())
            ->where('id_client', $idClient->value())
            ->where('actived', 1)
            ->firstOrFail();

        // Return Domain Ticket Type model
        return new TicketPrice(
            new TicketPriceId($ticketPrice->id),
            new TicketPriceCode($ticketPrice->code),
            new TicketPricePrice($ticketPrice->price),
            new TicketPriceActived($ticketPrice->actived),
            new TicketPriceDeleted($ticketPrice->deleted),
            new TicketPriceIdClient($ticketPrice->id_client),
            new TicketPriceDistance($ticketPrice->distance)
        );
    }

}
