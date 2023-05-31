<?php


namespace Src\VehicleTicketing\TicketPrice\Infraestructure;


use Illuminate\Http\Request;
use InvalidArgumentException;
use Src\VehicleTicketing\TicketPrice\Application\GetTicketPriceActivedByCriteriaUseCase;
use Src\VehicleTicketing\TicketPrice\Infraestructure\Repositories\EloquentTicketPriceRepository;

final class GetTicketPriceByCriteriaController
{
    private $repository;

    public function __construct(EloquentTicketPriceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request )
    {
        $this->validate($request);
        $TicketPriceCode = $request->code;
        $TicketTPriceIdClient = $request->idClient;
        $getTicketPriceByCriteriaUseCase = new GetTicketPriceActivedByCriteriaUseCase($this->repository);
        return $getTicketPriceByCriteriaUseCase->__invoke($TicketPriceCode,$TicketTPriceIdClient);
    }

    public function validate( Request $request ){
        if( !is_numeric ($request->code) ){
            throw new InvalidArgumentException('TicketPrice price required float format - '.$request->price );
        }
    }
}
