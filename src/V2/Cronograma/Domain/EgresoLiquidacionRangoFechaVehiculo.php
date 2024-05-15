<?php
declare(strict_types=1);

namespace Src\V2\Cronograma\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\Text;

final class CronogramaLiquidacionRangoFechaVehiculo
{
    private Id $idVehiculo;
    private Id $idCronogramaTipo;
    private Text $CronogramaTipo;
    private Text $detalle;
    private DateFormat $fecha;
    private NumericFloat $total;

    /**
     * @param Id $idVehiculo
     * @param Id $idCronogramaTipo
     * @param Text $CronogramaTipo
     * @param Text $detalle
     * @param DateFormat $fecha
     * @param NumericFloat $total
     */
    public function __construct(
        Id $idVehiculo,
        Id $idCronogramaTipo,
        Text $CronogramaTipo,
        Text $detalle,
        DateFormat $fecha,
        NumericFloat $total
    )
    {
        $this->idVehiculo = $idVehiculo;
        $this->idCronogramaTipo = $idCronogramaTipo;
        $this->CronogramaTipo = $CronogramaTipo;
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
    public function getIdCronogramaTipo(): Id
    {
        return $this->idCronogramaTipo;
    }

    /**
     * @param Id $idCronogramaTipo
     */
    public function setIdCronogramaTipo(Id $idCronogramaTipo): void
    {
        $this->idCronogramaTipo = $idCronogramaTipo;
    }

    /**
     * @return Text
     */
    public function getCronogramaTipo(): Text
    {
        return $this->CronogramaTipo;
    }

    /**
     * @param Text $CronogramaTipo
     */
    public function setCronogramaTipo(Text $CronogramaTipo): void
    {
        $this->CronogramaTipo = $CronogramaTipo;
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
