<?php


namespace Src\VehicleTicketing\TicketPrice\Infraestructure;


use Illuminate\Http\Request;
use Src\VehicleTicketing\TicketPrice\Application\GetTicketPriceActivedUseCase;
use Src\VehicleTicketing\TicketPrice\Infraestructure\Repositories\EloquentTicketPriceRepository;

final class GetTicketPriceController
{
    private $repository;

    public function __construct(EloquentTicketPriceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $ticketPriceId = $request->id;

        $getTicketPriceUseCase = new GetTicketPriceActivedUseCase($this->repository);
        return $getTicketPriceUseCase->__invoke($ticketPriceId);
    }
}
