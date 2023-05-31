<?php

declare(strict_types=1);

namespace Src\TransportePersonal\Reporte\Domain;

use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Text;

final class Reporte
{
    /**
     * @var Id
     */
    private $id;
    /**
     * @var Text
     */
    private $matricula;
    /**
     * @var Id
     */
    private $idTipoRuta;
    /**
     * @var Text
     */
    private $tipoRuta;
    /**
     * @var Id
     */
    private $idParaderoAbordaje;
    /**
     * @var Text
     */
    private $paraderoAbordaje;
    /**
     * @var Id
     */
    private $idParaderoDestino;
    /**
     * @var Text
     */
    private $paraderoDestino;
    /**
     * @var DateTimeFormat
     */
    private $fecha;

    /**
     * @param Id $id
     * @param Text $matricula
     * @param Id $idTipoRuta
     * @param Text $tipoRuta
     * @param Id $idParaderoAbordaje
     * @param Text $paraderoAbordaje
     * @param Id $idParaderoDestino
     * @param Text $paraderoDestino
     * @param DateTimeFormat $fecha
     */
    public function __construct(
        Id $id,
        Text $matricula,
        Id $idTipoRuta,
        Text $tipoRuta,
        Id $idParaderoAbordaje,
        Text $paraderoAbordaje,
        Id $idParaderoDestino,
        Text $paraderoDestino,
        DateTimeFormat $fecha
    )
    {

        $this->id = $id;
        $this->matricula = $matricula;
        $this->idTipoRuta = $idTipoRuta;
        $this->tipoRuta = $tipoRuta;
        $this->idParaderoAbordaje = $idParaderoAbordaje;
        $this->paraderoAbordaje = $paraderoAbordaje;
        $this->idParaderoDestino = $idParaderoDestino;
        $this->paraderoDestino = $paraderoDestino;
        $this->fecha = $fecha;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @param Id $id
     */
    public function setId(Id $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Text
     */
    public function getMatricula(): Text
    {
        return $this->matricula;
    }

    /**
     * @param Text $matricula
     */
    public function setMatricula(Text $matricula): void
    {
        $this->matricula = $matricula;
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

    /**
     * @return Id
     */
    public function getIdParaderoAbordaje(): Id
    {
        return $this->idParaderoAbordaje;
    }

    /**
     * @param Id $idParaderoAbordaje
     */
    public function setIdParaderoAbordaje(Id $idParaderoAbordaje): void
    {
        $this->idParaderoAbordaje = $idParaderoAbordaje;
    }

    /**
     * @return Text
     */
    public function getParaderoAbordaje(): Text
    {
        return $this->paraderoAbordaje;
    }

    /**
     * @param Text $paraderoAbordaje
     */
    public function setParaderoAbordaje(Text $paraderoAbordaje): void
    {
        $this->paraderoAbordaje = $paraderoAbordaje;
    }

    /**
     * @return Id
     */
    public function getIdParaderoDestino(): Id
    {
        return $this->idParaderoDestino;
    }

    /**
     * @param Id $idParaderoDestino
     */
    public function setIdParaderoDestino(Id $idParaderoDestino): void
    {
        $this->idParaderoDestino = $idParaderoDestino;
    }

    /**
     * @return Text
     */
    public function getParaderoDestino(): Text
    {
        return $this->paraderoDestino;
    }

    /**
     * @param Text $paraderoDestino
     */
    public function setParaderoDestino(Text $paraderoDestino): void
    {
        $this->paraderoDestino = $paraderoDestino;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFecha(): DateTimeFormat
    {
        return $this->fecha;
    }

    /**
     * @param DateTimeFormat $fecha
     */
    public function setFecha(DateTimeFormat $fecha): void
    {
        $this->fecha = $fecha;
    }


}
