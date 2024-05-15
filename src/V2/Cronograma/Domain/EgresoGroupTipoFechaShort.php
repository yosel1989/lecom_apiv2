<?php
declare(strict_types=1);

namespace Src\V2\Cronograma\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\Text;

final class CronogramaGroupTipoFechaShort
{
    private Id $idCliente;
    private Id $idCronogramaTipo;
    private Text $CronogramaTipo;
    private NumericFloat $total;
    private DateFormat $fecha;

    private Id $idVehiculo;


    /**
     * @param Id $idCliente
     * @param Id $idCronogramaTipo
     * @param Text $CronogramaTipo
     * @param NumericFloat $total
     * @param DateFormat $fecha
     */
    public function __construct(
        Id $idCliente,
        Id $idCronogramaTipo,
        Text $CronogramaTipo,
        NumericFloat $total,
        DateFormat $fecha
    )
    {

        $this->idCliente = $idCliente;
        $this->idCronogramaTipo = $idCronogramaTipo;
        $this->CronogramaTipo = $CronogramaTipo;
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
