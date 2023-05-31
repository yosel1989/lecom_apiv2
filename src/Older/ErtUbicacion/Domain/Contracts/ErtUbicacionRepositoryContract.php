<?php


namespace Src\Older\ErtUbicacion\Domain\Contracts;


use Src\Older\Ert\Domain\ValueObjects\ErtId;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slatitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slongitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Svelocidad;
use Src\Utility\UDateTime;

interface ErtUbicacionRepositoryContract
{

    public function register(
        ErtId $ertId,
        UDateTime $fecha,
        Slatitud $latitud,
        Slongitud $longitud,
        Svelocidad $velocidad
    ): void;

    public function registerUbication(
        ErtId $ertId,
        UDateTime $fecha,
        Slatitud $latitud,
        Slongitud $longitud,
        Svelocidad $velocidad
    ): void;

}
