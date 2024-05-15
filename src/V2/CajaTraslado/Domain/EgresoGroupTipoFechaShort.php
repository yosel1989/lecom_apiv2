<?php
declare(strict_types=1);

namespace Src\V2\CajaTraslado\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\Text;

final class CajaTrasladoGroupTipoFechaShort
{
    private Id $idCliente;
    private Id $idCajaTrasladoTipo;
    private Text $CajaTrasladoTipo;
    private NumericFloat $total;
    private DateFormat $fecha;

    private Id $idVehiculo;


    /**
     * @param Id $idCliente
     * @param Id $idCajaTrasladoTipo
     * @param Text $CajaTrasladoTipo
     * @param NumericFloat $total
     * @param DateFormat $fecha
     */
    public function __construct(
        Id $idCliente,
        Id $idCajaTrasladoTipo,
        Text $CajaTrasladoTipo,
        NumericFloat $total,
        DateFormat $fecha
    )
    {

        $this->idCliente = $idCliente;
        $this->idCajaTrasladoTipo = $idCajaTrasladoTipo;
        $this->CajaTrasladoTipo = $CajaTrasladoTipo;
        $this->total = $total;
        $this->fecha = $fecha;
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



}
