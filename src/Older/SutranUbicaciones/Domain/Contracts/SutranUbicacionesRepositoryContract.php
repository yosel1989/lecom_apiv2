<?php


namespace Src\Older\SutranUbicaciones\Domain\Contracts;


use Src\Older\SutranUbicaciones\Domain\ValueObjects\Sevento;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slatitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slongitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Splaca;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Srumbo;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Svelocidad;
use Src\Utility\UDateTime;

interface SutranUbicacionesRepositoryContract
{

    public function register(
        Splaca $placa,
        Slatitud $latitud,
        Slongitud $longitud,
        Srumbo $rumbo,
        Svelocidad $velocidad,
        Sevento $evento,
        UDateTime $fechaemv,
        UDateTime $fecha,
        UDateTime $tms
    ): void;

}
