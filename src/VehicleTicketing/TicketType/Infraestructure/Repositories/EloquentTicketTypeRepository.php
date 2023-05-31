<?php


namespace Src\VehicleTicketing\TicketType\Infraestructure\Repositories;


use App\Models\VehicleTicketing\TicketType as EloquentTicketTypeModel;
use Src\VehicleTicketing\TicketType\Domain\Contracts\TicketTypeRepositoryContract;
use Src\VehicleTicketing\TicketType\Domain\TicketType;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeCode;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeId;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeType;

final class EloquentTicketTypeRepository implements TicketTypeRepositoryContract
{
    /**
     * @var EloquentTicketTypeModel
     */
    private $eloquentTicketTypeModel;

    public function __construct()
    {
        $this->eloquentTicketTypeModel = new EloquentTicketTypeModel;
    }

    public function find(TicketTypeId $id): ?TicketType
    {

        $ticket = $this->eloquentTicketTypeModel->findOrFail($id->value());

        // Return Domain Ticket model
        return new TicketType(
            new TicketTypeId($ticket->id),
            new TicketTypeType($ticket->type),
            new TicketTypeCode($ticket->code)
        );

    }

    public function findByCode(TicketTypeCode $code): ?TicketType
    {
        $ticket = $this->eloquentTicketTypeModel
            ->where('code', $code->value())
            ->firstOrFail();

        // Return Domain Ticket Type model
        return new TicketType(
            new TicketTypeId($ticket->id),
            new TicketTypeType($ticket->type),
            new TicketTypeCode($ticket->code)
        );
    }

    public function collection(): array
    {
        $tickets = $this->eloquentTicketTypeModel->all();

        $collection = [];

        foreach ( $tickets as $ticket ){
            $Ticket = new TicketType(
                new TicketTypeId($ticket->id),
                new TicketTypeType($ticket->type),
                new TicketTypeCode($ticket->code)
            );
            $collection[] = $Ticket;
        }
        return $collection;
    }

}
