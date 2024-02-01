<?php
declare(strict_types=1);

namespace Src\V2\Egreso\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\Text;

final class EgresoGroupTipoFechaShort
{
    private Id $idCliente;
    private Id $idEgresoTipo;
    private Text $egresoTipo;
    private NumericFloat $total;
    private DateFormat $fecha;

    private Id $idVehiculo;


    /**
     * @param Id $idCliente
     * @param Id $idEgresoTipo
     * @param Text $egresoTipo
     * @param NumericFloat $total
     * @param DateFormat $fecha
     */
    public function __construct(
        Id $idCliente,
        Id $idEgresoTipo,
        Text $egresoTipo,
        NumericFloat $total,
        DateFormat $fecha
    )
    {

        $this->idCliente = $idCliente;
        $this->idEgresoTipo = $idEgresoTipo;
        $this->egresoTipo = $egresoTipo;
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
