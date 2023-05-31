<?php


namespace Src\Older\SutranUbicaciones\Application;


use Src\Older\SutranUbicaciones\Domain\Contracts\SutranUbicacionesRepositoryContract;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Sevento;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slatitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slongitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Splaca;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Srumbo;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Svelocidad;
use Src\Utility\UDateTime;

final class RegisterSutranUseCase
{
    private $repository;

    public function __construct( SutranUbicacionesRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $placa,
        float $latitud,
        float $longitud,
        int $rumbo,
        float $velocidad,
        string $evento,
        string $fechaemv,
        string $fecha,
        string $tms
    ): void
    {
        $Splaca = new Splaca($placa);
        $Slatitud = new Slatitud($latitud);
        $Slongitud = new Slongitud($longitud);
        $Srumbo = new Srumbo($rumbo);
        $Svelocidad = new Svelocidad($velocidad);
        $Sevento = new Sevento($evento);
        $Sfechaemv = new UDateTime($fechaemv);
        $Sfecha = new UDateTime($fecha);
        $Stms = new UDateTime($tms);
        $this->repository->register(
            $Splaca,
            $Slatitud,
            $Slongitud,
            $Srumbo,
            $Svelocidad,
            $Sevento,
            $Sfechaemv,
            $Sfecha,
            $Stms
        );
    }
}
