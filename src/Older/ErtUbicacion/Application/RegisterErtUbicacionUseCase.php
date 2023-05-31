<?php


namespace Src\Older\ErtUbicacion\Application;


use Src\Older\Ert\Domain\ValueObjects\ErtId;
use Src\Older\ErtUbicacion\Domain\Contracts\ErtUbicacionRepositoryContract;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slatitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slongitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Svelocidad;
use Src\Utility\UDateTime;

final class RegisterErtUbicacionUseCase
{
    private $repository;

    public function __construct( ErtUbicacionRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $ertId,
        string $datetime,
        float $latitude,
        float $longitude,
        float $velocity
    ): void
    {
        $EUertId = new ErtId($ertId);
        $EUfecha = new UDateTime($datetime);
        $EUlatitud = new Slatitud($latitude);
        $EUlongitud = new Slongitud($longitude);
        $EUvelocidad = new Svelocidad($velocity);

        $this->repository->register(
            $EUertId,
            $EUfecha,
            $EUlatitud,
            $EUlongitud,
            $EUvelocidad
        );
    }
}
