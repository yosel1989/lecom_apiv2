<?php
declare(strict_types=1);

namespace Src\V2\Egreso\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\Text;

final class EgresoLiquidacionRangoFechaVehiculo
{
    private Id $idVehiculo;
    private Id $idEgresoTipo;
    private Text $egresoTipo;
    private Text $detalle;
    private DateFormat $fecha;
    private NumericFloat $total;

    /**
     * @param Id $idVehiculo
     * @param Id $idEgresoTipo
     * @param Text $egresoTipo
     * @param Text $detalle
     * @param DateFormat $fecha
     * @param NumericFloat $total
     */
    public function __construct(
        Id $idVehiculo,
        Id $idEgresoTipo,
        Text $egresoTipo,
        Text $detalle,
        DateFormat $fecha,
        NumericFloat $total
    )
    {
        $this->idVehiculo = $idVehiculo;
        $this->idEgresoTipo = $idEgresoTipo;
        $this->egresoTipo = $egresoTipo;
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
    public function getIdEgresoTipo(): Id
    {
        return $this->idEgresoTipo;
    }

    /**
     * @param Id $idEgresoTipo
     */
    public function setIdEgresoTipo(Id $idEgresoTipo): void
    {
        $this->idEgresoTipo = $idEgresoTipo;
    }

    /**
     * @return Text
     */
    public function getEgresoTipo(): Text
    {
        return $this->egresoTipo;
    }

    /**
     * @param Text $egresoTipo
     */
    public function setEgresoTipo(Text $egresoTipo): void
    {
        $this->egresoTipo = $egresoTipo;
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
