<?php

namespace Src\V2\BoletoInterprovincial\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\TimeFormat;

final class BoletoInterprovincialPasajero
{
    private Text $nombre;
    private Text $apellido;
    private Text $tipoDocumento;
    private Text $numeroDocumento;
    private Text $destino;
    private DateFormat $fechaPartida;
    private TimeFormat $horaPartida;

    /**
     * @param Text $nombre
     * @param Text $apellido
     * @param Text $tipoDocumento
     * @param Text $numeroDocumento
     * @param Text $destino
     */
    public function __construct(
        Text $nombre,
        Text $apellido,
        Text $tipoDocumento,
        Text $numeroDocumento,
        Text $destino,
        DateFormat $fechaPartida,
        TimeFormat $horaPartida
    )
    {

        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->tipoDocumento = $tipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
        $this->destino = $destino;
        $this->fechaPartida = $fechaPartida;
        $this->horaPartida = $horaPartida;
    }

    /**
     * @return Text
     */
    public function getNombre(): Text
    {
        return $this->nombre;
    }

    /**
     * @param Text $nombre
     */
    public function setNombre(Text $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return Text
     */
    public function getApellido(): Text
    {
        return $this->apellido;
    }

    /**
     * @param Text $apellido
     */
    public function setApellido(Text $apellido): void
    {
        $this->apellido = $apellido;
    }

    /**
     * @return Text
     */
    public function getTipoDocumento(): Text
    {
        return $this->tipoDocumento;
    }

    /**
     * @param Text $tipoDocumento
     */
    public function setTipoDocumento(Text $tipoDocumento): void
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    /**
     * @return Text
     */
    public function getNumeroDocumento(): Text
    {
        return $this->numeroDocumento;
    }

    /**
     * @param Text $numeroDocumento
     */
    public function setNumeroDocumento(Text $numeroDocumento): void
    {
        $this->numeroDocumento = $numeroDocumento;
    }

    /**
     * @return Text
     */
    public function getDestino(): Text
    {
        return $this->destino;
    }

    /**
     * @param Text $destino
     */
    public function setDestino(Text $destino): void
    {
        $this->destino = $destino;
    }

    /**
     * @return DateFormat
     */
    public function getFechaPartida(): DateFormat
    {
        return $this->fechaPartida;
    }

    /**
     * @param DateFormat $fechaPartida
     */
    public function setFechaPartida(DateFormat $fechaPartida): void
    {
        $this->fechaPartida = $fechaPartida;
    }

    /**
     * @return TimeFormat
     */
    public function getHoraPartida(): TimeFormat
    {
        return $this->horaPartida;
    }

    /**
     * @param TimeFormat $horaPartida
     */
    public function setHoraPartida(TimeFormat $horaPartida): void
    {
        $this->horaPartida = $horaPartida;
    }


}
