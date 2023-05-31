<?php

declare(strict_types=1);

namespace Src\Older\SutranUbicaciones\Domain;


use Src\Older\SutranUbicaciones\Domain\ValueObjects\Sevento;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Sid;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slatitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slongitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Splaca;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Srumbo;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Svelocidad;
use Src\Utility\UDateTime;

final class SutranUbicaciones
{
    /**
     * @var Sid
     */
    private $id;
    /**
     * @var Splaca
     */
    private $placa;
    /**
     * @var Slatitud
     */
    private $latitud;
    /**
     * @var Slongitud
     */
    private $longitud;
    /**
     * @var Srumbo
     */
    private $rumbo;
    /**
     * @var Svelocidad
     */
    private $velocidad;
    /**
     * @var Sevento
     */
    private $evento;
    /**
     * @var UDateTime
     */
    private $fechaEmv;
    /**
     * @var UDateTime
     */
    private $fecha;
    /**
     * @var UDateTime
     */
    private $tms;

    /**
     * SutranUbicaciones constructor.
     * @param Sid $id
     * @param Splaca $placa
     * @param Slatitud $latitud
     * @param Slongitud $longitud
     * @param Srumbo $rumbo
     * @param Svelocidad $velocidad
     * @param Sevento $evento
     * @param UDateTime $fechaEmv
     * @param UDateTime $fecha
     * @param UDateTime $tms
     */
    public function __construct(
        Sid  $id,
        Splaca $placa,
        Slatitud $latitud,
        Slongitud $longitud,
        Srumbo $rumbo,
        Svelocidad $velocidad,
        Sevento $evento,
        UDateTime $fechaEmv,
        UDateTime $fecha,
        UDateTime $tms
    )
    {

        $this->id = $id;
        $this->placa = $placa;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->rumbo = $rumbo;
        $this->velocidad = $velocidad;
        $this->evento = $evento;
        $this->fechaEmv = $fechaEmv;
        $this->fecha = $fecha;
        $this->tms = $tms;
    }

    /**
     * @return Sid
     */
    public function getId(): Sid
    {
        return $this->id;
    }

    /**
     * @return Splaca
     */
    public function getPlaca(): Splaca
    {
        return $this->placa;
    }

    /**
     * @return Slatitud
     */
    public function getLatitud(): Slatitud
    {
        return $this->latitud;
    }

    /**
     * @return Slongitud
     */
    public function getLongitud(): Slongitud
    {
        return $this->longitud;
    }

    /**
     * @return Srumbo
     */
    public function getRumbo(): Srumbo
    {
        return $this->rumbo;
    }

    /**
     * @return Svelocidad
     */
    public function getVelocidad(): Svelocidad
    {
        return $this->velocidad;
    }

    /**
     * @return Sevento
     */
    public function getEvento(): Sevento
    {
        return $this->evento;
    }

    /**
     * @return UDateTime
     */
    public function getFechaEmv(): UDateTime
    {
        return $this->fechaEmv;
    }

    /**
     * @return UDateTime
     */
    public function getFecha(): UDateTime
    {
        return $this->fecha;
    }

    /**
     * @return UDateTime
     */
    public function getTms(): UDateTime
    {
        return $this->tms;
    }



}
