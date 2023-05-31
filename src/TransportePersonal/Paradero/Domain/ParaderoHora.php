<?php

declare(strict_types=1);

namespace Src\TransportePersonal\Paradero\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\ModelBase\Domain\ValueObjects\TimeFormat;

final class ParaderoHora
{
    /**
     * @var Id
     */
    private $idRuta;
    /**
     * @var Id
     */
    private $idTipoRuta;
    /**
     * @var float|int|Numeric|string
     */
    private $idTipoParadero;
    /**
     * @var TimeFormat
     */
    private $hora;
    /**
     * @var Text
     */
    private $ruta;
    /**
     * @var Text
     */
    private $tipoRuta;

    /**
     * @param Id $idRuta
     * @param Id $idTipoRuta
     * @param Numeric $idTipoParadero
     * @param TimeFormat $hora
     */
    public function __construct(
        Id $idRuta,
        Id $idTipoRuta,
        Numeric $idTipoParadero,
        TimeFormat $hora
    )
    {

        $this->idRuta = $idRuta;
        $this->idTipoRuta = $idTipoRuta;
        $this->idTipoParadero = $idTipoParadero;
        $this->hora = $hora;
    }

    /**
     * @return Id
     */
    public function getIdRuta(): Id
    {
        return $this->idRuta;
    }

    /**
     * @param Id $idRuta
     */
    public function setIdRuta(Id $idRuta): void
    {
        $this->idRuta = $idRuta;
    }

    /**
     * @return Id
     */
    public function getIdTipoRuta(): Id
    {
        return $this->idTipoRuta;
    }

    /**
     * @param Id $idTipoRuta
     */
    public function setIdTipoRuta(Id $idTipoRuta): void
    {
        $this->idTipoRuta = $idTipoRuta;
    }

    /**
     * @return float|int|Numeric|string
     */
    public function getIdTipoParadero()
    {
        return $this->idTipoParadero;
    }

    /**
     * @param float|int|Numeric|string $idTipoParadero
     */
    public function setIdTipoParadero($idTipoParadero): void
    {
        $this->idTipoParadero = $idTipoParadero;
    }

    /**
     * @return TimeFormat
     */
    public function getHora(): TimeFormat
    {
        return $this->hora;
    }

    /**
     * @param TimeFormat $hora
     */
    public function setHora(TimeFormat $hora): void
    {
        $this->hora = $hora;
    }

    /**
     * @return Text
     */
    public function getRuta(): Text
    {
        return $this->ruta;
    }

    /**
     * @param Text $ruta
     */
    public function setRuta(Text $ruta): void
    {
        $this->ruta = $ruta;
    }

    /**
     * @return Text
     */
    public function getTipoRuta(): Text
    {
        return $this->tipoRuta;
    }

    /**
     * @param Text $tipoRuta
     */
    public function setTipoRuta(Text $tipoRuta): void
    {
        $this->tipoRuta = $tipoRuta;
    }


}
