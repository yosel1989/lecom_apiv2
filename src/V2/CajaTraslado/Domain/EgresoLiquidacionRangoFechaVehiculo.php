<?php
declare(strict_types=1);

namespace Src\V2\CajaTraslado\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\Text;

final class CajaTrasladoLiquidacionRangoFechaVehiculo
{
    private Id $idVehiculo;
    private Id $idCajaTrasladoTipo;
    private Text $CajaTrasladoTipo;
    private Text $detalle;
    private DateFormat $fecha;
    private NumericFloat $total;

    /**
     * @param Id $idVehiculo
     * @param Id $idCajaTrasladoTipo
     * @param Text $CajaTrasladoTipo
     * @param Text $detalle
     * @param DateFormat $fecha
     * @param NumericFloat $total
     */
    public function __construct(
        Id $idVehiculo,
        Id $idCajaTrasladoTipo,
        Text $CajaTrasladoTipo,
        Text $detalle,
        DateFormat $fecha,
        NumericFloat $total
    )
    {
        $this->idVehiculo = $idVehiculo;
        $this->idCajaTrasladoTipo = $idCajaTrasladoTipo;
        $this->CajaTrasladoTipo = $CajaTrasladoTipo;
        $this->detalle = $detalle;
        $this->fecha = $fecha;
        $this->total = $total;
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
     * @return Id
     */
    public function getIdCajaTrasladoTipo(): Id
    {
        return $this->idCajaTrasladoTipo;
    }

    /**
     * @param Id $idCajaTrasladoTipo
     */
    public function setIdCajaTrasladoTipo(Id $idCajaTrasladoTipo): void
    {
        $this->idCajaTrasladoTipo = $idCajaTrasladoTipo;
    }

    /**
     * @return Text
     */
    public function getCajaTrasladoTipo(): Text
    {
        return $this->CajaTrasladoTipo;
    }

    /**
     * @param Text $CajaTrasladoTipo
     */
    public function setCajaTrasladoTipo(Text $CajaTrasladoTipo): void
    {
        $this->CajaTrasladoTipo = $CajaTrasladoTipo;
    }

    /**
     * @return Text
     */
    public function getDetalle(): Text
    {
        return $this->detalle;
    }

    /**
     * @param Text $detalle
     */
    public function setDetalle(Text $detalle): void
    {
        $this->detalle = $detalle;
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
     * @return NumericFloat
     */
    public function getTotal(): NumericFloat
    {
        return $this->total;
    }

    /**
     * @param NumericFloat $total
     */
    public function setTotal(NumericFloat $total): void
    {
        $this->total = $total;
    }


}
