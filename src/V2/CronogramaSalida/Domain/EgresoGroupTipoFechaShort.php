<?php
declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\Text;

final class CronogramaSalidaGroupTipoFechaShort
{
    private Id $idCliente;
    private Id $idCronogramaSalidaTipo;
    private Text $CronogramaSalidaTipo;
    private NumericFloat $total;
    private DateFormat $fecha;

    private Id $idVehiculo;


    /**
     * @param Id $idCliente
     * @param Id $idCronogramaSalidaTipo
     * @param Text $CronogramaSalidaTipo
     * @param NumericFloat $total
     * @param DateFormat $fecha
     */
    public function __construct(
        Id $idCliente,
        Id $idCronogramaSalidaTipo,
        Text $CronogramaSalidaTipo,
        NumericFloat $total,
        DateFormat $fecha
    )
    {

        $this->idCliente = $idCliente;
        $this->idCronogramaSalidaTipo = $idCronogramaSalidaTipo;
        $this->CronogramaSalidaTipo = $CronogramaSalidaTipo;
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
