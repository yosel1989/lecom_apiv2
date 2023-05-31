<?php


namespace Src\VehicleTicketing\Ticket\Infraestructure;



use Src\VehicleTicketing\Ticket\Application\GetTicketsTodayByVehicleUseCase;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;
use Src\VehicleTicketing\Ticket\Infraestructure\Repositories\EloquentTicketRepository;

final class GetTicketsTodayByVehicleController
{
    private $repository;

    public function __construct(EloquentTicketRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idVehicle )
    {
        $idVehicle = new TicketIdVehicle($idVehicle);
        $getTicketsTodayByVehicleUseCase = new GetTicketsTodayByVehicleUseCase($this->repository);
        return $getTicketsTodayByVehicleUseCase->__invoke($idVehicle);
    }
}
