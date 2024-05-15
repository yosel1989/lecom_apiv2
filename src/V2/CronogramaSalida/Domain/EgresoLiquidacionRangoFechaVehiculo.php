<?php
declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\Text;

final class CronogramaSalidaLiquidacionRangoFechaVehiculo
{
    private Id $idVehiculo;
    private Id $idCronogramaSalidaTipo;
    private Text $CronogramaSalidaTipo;
    private Text $detalle;
    private DateFormat $fecha;
    private NumericFloat $total;

    /**
     * @param Id $idVehiculo
     * @param Id $idCronogramaSalidaTipo
     * @param Text $CronogramaSalidaTipo
     * @param Text $detalle
     * @param DateFormat $fecha
     * @param NumericFloat $total
     */
    public function __construct(
        Id $idVehiculo,
        Id $idCronogramaSalidaTipo,
        Text $CronogramaSalidaTipo,
        Text $detalle,
        DateFormat $fecha,
        NumericFloat $total
    )
    {
        $this->idVehiculo = $idVehiculo;
        $this->idCronogramaSalidaTipo = $idCronogramaSalidaTipo;
        $this->CronogramaSalidaTipo = $CronogramaSalidaTipo;
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
    public function getIdCronogramaSalidaTipo(): Id
    {
        return $this->idCronogramaSalidaTipo;
    }

    /**
     * @param Id $idCronogramaSalidaTipo
     */
    public function setIdCronogramaSalidaTipo(Id $idCronogramaSalidaTipo): void
    {
        $this->idCronogramaSalidaTipo = $idCronogramaSalidaTipo;
    }

    /**
     * @return Text
     */
    public function getCronogramaSalidaTipo(): Text
    {
        return $this->CronogramaSalidaTipo;
    }

    /**
     * @param Text $CronogramaSalidaTipo
     */
    public function setCronogramaSalidaTipo(Text $CronogramaSalidaTipo): void
    {
        $this->CronogramaSalidaTipo = $CronogramaSalidaTipo;
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
