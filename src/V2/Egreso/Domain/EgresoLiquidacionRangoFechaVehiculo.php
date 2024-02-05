<?php
declare(strict_types=1);

namespace Src\V2\Egreso\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;

final class EgresoLiquidacionRangoFechaVehiculo
{
    private Id $idCliente;
    private Id $idVehiculo;
    private DateFormat $fecha;
    private NumericFloat $total;

    /**
     * @param Id $idCliente
     * @param Id $idVehiculo
     * @param DateFormat $fecha
     * @param NumericFloat $total
     */
    public function __construct(
        Id $idCliente,
        Id $idVehiculo,
        DateFormat $fecha,
        NumericFloat $total
    )
    {

        $this->idCliente = $idCliente;
        $this->idVehiculo = $idVehiculo;
        $this->fecha = $fecha;
        $this->total = $total;
    }

    /**
     * @return Id
     */
    public function getIdCliente(): Id
    {
        return $this->idCliente;
    }

    /**
     * @param Id $idCliente
     */
    public function setIdCliente(Id $idCliente): void
    {
        $this->idCliente = $idCliente;
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
