<?php


namespace Src\VehicleTicketing\Ticket\Infraestructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\VehicleTicketing\Ticket\Application\CreateTicketUseCase;
use Src\VehicleTicketing\Ticket\Application\GetLastTicketUseCase;
//use Src\VehicleTicketing\Ticket\Application\GetTicketByCodeDateUseCase;
use Src\VehicleTicketing\Ticket\Application\GetTicketByCodeAndDateUseCase;
use Src\VehicleTicketing\Ticket\Application\GetTicketWithRelationsUseCase;
use Src\VehicleTicketing\Ticket\Domain\Ticket;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketCode;
use Src\VehicleTicketing\Ticket\Infraestructure\Repositories\EloquentTicketRepository;
use Src\VehicleTicketing\TicketMachine\Application\GetTicketMachineByImeiUseCase;
use Src\VehicleTicketing\TicketMachine\Infraestructure\Repositories\EloquentTicketMachineRepository;
use Src\VehicleTicketing\TicketPrice\Application\GetTicketPriceActivedByCriteriaUseCase;
use Src\VehicleTicketing\TicketPrice\Infraestructure\Repositories\EloquentTicketPriceRepository;
use Src\VehicleTicketing\TicketType\Application\GetTicketTypeByCodeUseCase;
use Src\VehicleTicketing\TicketType\Infraestructure\Repositories\EloquentTicketTypeRepository;

final class CreateTicketController
{

    /**
     * @var EloquentTicketRepository
     */
    private $repository;
    /**
     * @var EloquentTicketMachineRepository
     */
    private $ticketMachineRepository;
    /**
     * @var EloquentTicketPriceRepository
     */
    private $ticketPriceRepository;
    /**
     * @var EloquentTicketTypeRepository
     */
    private $ticketTypeRepository;

    public function __construct( EloquentTicketRepository $repository )
    {
        $this->repository = $repository;
        $this->ticketMachineRepository = new EloquentTicketMachineRepository();
        $this->ticketTypeRepository = new EloquentTicketTypeRepository();
        $this->ticketPriceRepository = new EloquentTicketPriceRepository();
    }

    public function __invoke( Request $request ): ?Ticket
    {
        $getTicketByCodeDateUseCase = new GetTicketByCodeAndDateUseCase( $this->repository );
        $foundTicket = $getTicketByCodeDateUseCase->__invoke( $request->input('code_ticket'),$request->input('date') );

        if(!is_null($foundTicket)){
            return $foundTicket;
        }

        $getTicketMachineByImeiUseCase = new GetTicketMachineByImeiUseCase( $this->ticketMachineRepository );
        $TicketMachine = $getTicketMachineByImeiUseCase->__invoke($request->input('imei_ticket_machine'));

        $getTicketTypeByCodeUseCase = new GetTicketTypeByCodeUseCase( $this->ticketTypeRepository );
        $TicketType = $getTicketTypeByCodeUseCase->__invoke($request->input('code_ticket_type'));

        $getTicketPriceByCriteriaUseCase = new GetTicketPriceActivedByCriteriaUseCase( $this->ticketPriceRepository );
        $ticketPrice = $getTicketPriceByCriteriaUseCase->__invoke($request->input('code_ticket_price'), $TicketMachine->getIdClient()->value());

        $getLastTicketUseCase = new GetLastTicketUseCase( $this->repository );
        $lastTicket = $getLastTicketUseCase->__invoke( $TicketMachine->getId()->value() );

        $ticketId         = Uuid::uuid4();
        $ticketCode       = $request->input('code_ticket');
        $ticketDate       = $request->input('date');
        $ticketLatitude   = $request->has('latitude') ? $request->input('latitude') : 0;
        $ticketLongitude  = $request->has('longitude') ? $request->input('longitude') : 0;
        $ticketTurn       = Ticket::calculeTurn($lastTicket,new TicketCode($ticketCode));
        $ticketDeleted    = 0;
        $ticketIdClient   = $TicketMachine->getIdClient()->value();
        $ticketIdVehicle  = $TicketMachine->getIdVehicle()->value();
        $ticketIdMachine  = $TicketMachine->getId()->value();
        $ticketIdPrice    = $ticketPrice->getId()->value();
        $ticketIdType     = $TicketType->getId()->value();

        $createTicketCase = new CreateTicketUseCase( $this->repository );
        $createTicketCase->__invoke(
            $ticketId,
            $ticketCode,
            $ticketDate,
            $ticketLatitude,
            $ticketLongitude,
            $ticketTurn,
            $ticketDeleted,
            $ticketIdClient,
            $ticketIdVehicle,
            $ticketIdMachine,
            $ticketIdPrice,
            $ticketIdType
        );

        $getTicketUseCase = new GetTicketWithRelationsUseCase( $this->repository );
        return $getTicketUseCase->__invoke( $ticketId );

    }
}
