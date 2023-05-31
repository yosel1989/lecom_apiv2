<?php


namespace Src\VehicleTicketing\TicketType\Infraestructure;


use Illuminate\Http\Request;
use Src\VehicleTicketing\TicketType\Application\GetTicketTypeUseCase;
use Src\VehicleTicketing\TicketType\Infraestructure\Repositories\EloquentTicketTypeRepository;

final class GetTicketTypeController
{
    private $repository;

    public function __construct(EloquentTicketTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $userId = $request->id;

        $getTicketTypeUseCase = new GetTicketTypeUseCase($this->repository);
        return $getTicketTypeUseCase->__invoke($userId);
    }
}
