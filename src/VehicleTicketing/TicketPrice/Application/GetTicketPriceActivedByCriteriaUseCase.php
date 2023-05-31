<?php


namespace Src\VehicleTicketing\TicketPrice\Application;


use Src\VehicleTicketing\TicketPrice\Domain\Contracts\TicketPriceRepositoryContract;
use Src\VehicleTicketing\TicketPrice\Domain\TicketPrice;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceCode;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceIdClient;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPricePrice;

final class GetTicketPriceActivedByCriteriaUseCase
{
    private $repository;

    public function __construct(TicketPriceRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( int $code , string $idClient ): ?TicketPrice
    {
        $code = new TicketPriceCode($code);
        $idClient = new TicketPriceIdClient($idClient);

        return $this->repository->findByCriteria( $code, $idClient);
    }
}
