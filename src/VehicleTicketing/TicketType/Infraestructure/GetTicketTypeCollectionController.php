<?php


namespace Src\VehicleTicketing\TicketType\Infraestructure;


use Illuminate\Http\Request;
use Src\VehicleTicketing\TicketType\Application\GetTicketTypeCollectionUseCase;
use Src\VehicleTicketing\TicketType\Infraestructure\Repositories\EloquentTicketTypeRepository;

final class GetTicketTypeCollectionController
{
    private $repository;

    public function __construct(EloquentTicketTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): array
    {
        $getTicketTypeCollectionUseCase = new GetTicketTypeCollectionUseCase($this->repository);
        return $getTicketTypeCollectionUseCase->__invoke();
    }
}
