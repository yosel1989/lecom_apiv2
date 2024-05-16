<?php
declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\TimeFormat;

final class CronogramaSalidaShort
{
    private Id $id;
    private Id $idVehiculo;
    private DateFormat $fecha;
    private TimeFormat $hora;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;

    // secondary
    private Text $vehiculo;

    /**
     * @param Id $id
     * @param Id $idVehiculo
     * @param DateFormat $fecha
     * @param TimeFormat $hora
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        Id $id,
        Id $idVehiculo,
        DateFormat $fecha,
        TimeFormat $hora,
        NumericInteger $idEstado,
        NumericInteger $idEliminado
    )
    {
        $this->id = $id;
        $this->idVehiculo = $idVehiculo;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
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
     * @return Id
     */
    public function getIdVehiculo(): Id
    {
        return $this->idVehiculo;
    }

    /**
     * @param Id $idVehiculo
     */
    public function setIdVehiculo(Id $idVehiculo): void
    {
        $this->idVehiculo = $idVehiculo;
    }

    /**
     * @return DateFormat
     */
    public function getFecha(): DateFormat
    {
        return $this->fecha;
    }

    /**
     * @param DateFormat $fecha
     */
    public function setFecha(DateFormat $fecha): void
    {
        $this->fecha = $fecha;
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
     * @return NumericInteger
     */
    public function getIdEstado(): NumericInteger
    {
        return $this->idEstado;
    }

    /**
     * @param NumericInteger $idEstado
     */
    public function setIdEstado(NumericInteger $idEstado): void
    {
        $this->idEstado = $idEstado;
    }

    /**
     * @return NumericInteger
     */
    public function getIdEliminado(): NumericInteger
    {
        return $this->idEliminado;
    }

    /**
     * @param NumericInteger $idEliminado
     */
    public function setIdEliminado(NumericInteger $idEliminado): void
    {
        $this->idEliminado = $idEliminado;
    }

    /**
     * @return Text
     */
    public function getVehiculo(): Text
    {
        return $this->vehiculo;
    }

    /**
     * @param Text $vehiculo
     */
    public function setVehiculo(Text $vehiculo): void
    {
        $this->vehiculo = $vehiculo;
    }



}
