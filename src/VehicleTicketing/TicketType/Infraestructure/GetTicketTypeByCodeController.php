<?php


namespace Src\VehicleTicketing\TicketType\Infraestructure;


use Illuminate\Http\Request;
use InvalidArgumentException;
use Src\VehicleTicketing\TicketType\Application\GetTicketTypeByCodeUseCase;
use Src\VehicleTicketing\TicketType\Infraestructure\Repositories\EloquentTicketTypeRepository;

final class GetTicketTypeByCodeController
{
    private $repository;

    public function __construct(EloquentTicketTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( $code )
    {
        $this->validate($code);
        $TicketTypeCode = $code;
        $getTicketTypeByCodeUseCase = new GetTicketTypeByCodeUseCase($this->repository);
        return $getTicketTypeByCodeUseCase->__invoke($TicketTypeCode);
    }

    public function validate( $code ){
        if( !is_numeric ($code) ){
            throw new InvalidArgumentException('TicketTypeCode required integer format - '.$code );
        }
    }
}
