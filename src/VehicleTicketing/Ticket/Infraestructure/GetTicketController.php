<?php


namespace Src\VehicleTicketing\Ticket\Infraestructure;


use Illuminate\Http\Request;
use Src\VehicleTicketing\Ticket\Application\GetTicketUseCase;
use Src\VehicleTicketing\Ticket\Infraestructure\Repositories\EloquentTicketRepository;

final class GetTicketController
{
    private $repository;

    public function __construct(EloquentTicketRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $userId = $request->id;

        $getTicketUseCase = new GetTicketUseCase($this->repository);
        return $getTicketUseCase->__invoke($userId);
    }
}
