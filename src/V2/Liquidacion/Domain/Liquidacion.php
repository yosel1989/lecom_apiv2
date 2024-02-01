<?php
declare(strict_types=1);

namespace Src\V2\Liquidacion\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialShortFechaList;
use Src\V2\Egreso\Domain\EgresoGroupTipoFechaShortList;
use Src\V2\EgresoTipo\Domain\EgresoTipoShortList;
use Src\V2\Vehiculo\Domain\VehiculoShortList;

final class Liquidacion
{
    private Id $idCliente;
    private DateFormat $fechaDesde;
    private DateFormat $fechaHasta;
    private \DatePeriod $fechaPeriodo;
    private EgresoTipoShortList $egresoTipos;
    private EgresoGroupTipoFechaShortList $egresoTotal;
    private VehiculoShortList $vehiculos;
    private EgresoGroupTipoFechaShortList $egresoVehiculo;
    private BoletoInterprovincialShortFechaList $ingresoTotalBoleto;
    private BoletoInterprovincialShortFechaList $ingresoTotalBoletoPorVehiculo;

    /**
     * @param Id $idCliente
     * @param DateFormat $fechaDesde
     * @param DateFormat $fechaHasta
     * @param \DatePeriod $fechaPeriodo
     * @param EgresoTipoShortList $egresoTipos
     * @param EgresoGroupTipoFechaShortList $egresoTotal
     * @param EgresoGroupTipoFechaShortList $egresoVehiculo
     * @param BoletoInterprovincialShortFechaList $ingresoTotalBoleto
     * @param BoletoInterprovincialShortFechaList $ingresoTotalBoletoPorVehiculo
     * @param VehiculoShortList $vehiculos
     */
    public function __construct(
        Id $idCliente,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta,
        \DatePeriod $fechaPeriodo,
        EgresoTipoShortList $egresoTipos,
        EgresoGroupTipoFechaShortList $egresoTotal,
        EgresoGroupTipoFechaShortList $egresoVehiculo,
        BoletoInterprovincialShortFechaList $ingresoTotalBoleto,
        BoletoInterprovincialShortFechaList $ingresoTotalBoletoPorVehiculo,
        VehiculoShortList $vehiculos
    )
    {

        $this->idCliente = $idCliente;
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;
        $this->fechaPeriodo = $fechaPeriodo;
        $this->egresoTipos = $egresoTipos;
        $this->egresoTotal = $egresoTotal;
        $this->vehiculos = $vehiculos;
        $this->egresoVehiculo = $egresoVehiculo;
        $this->ingresoTotalBoleto = $ingresoTotalBoleto;
        $this->ingresoTotalBoletoPorVehiculo = $ingresoTotalBoletoPorVehiculo;
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
     * @return DateFormat
     */
    public function getFechaDesde(): DateFormat
    {
        return $this->fechaDesde;
    }

    /**
     * @param DateFormat $fechaDesde
     */
    public function setFechaDesde(DateFormat $fechaDesde): void
    {
        $this->fechaDesde = $fechaDesde;
    }

    /**
     * @return DateFormat
     */
    public function getFechaHasta(): DateFormat
    {
        return $this->fechaHasta;
    }

    /**
     * @param DateFormat $fechaHasta
     */
    public function setFechaHasta(DateFormat $fechaHasta): void
    {
        $this->fechaHasta = $fechaHasta;
    }

    /**
     * @return \DatePeriod
     */
    public function getFechaPeriodo(): \DatePeriod
    {
        return $this->fechaPeriodo;
    }

    /**
     * @param \DatePeriod $fechaPeriodo
     */
    public function setFechaPeriodo(\DatePeriod $fechaPeriodo): void
    {
        $this->fechaPeriodo = $fechaPeriodo;
    }

    /**
     * @return EgresoTipoShortList
     */
    public function getEgresoTipos(): EgresoTipoShortList
    {
        return $this->egresoTipos;
    }

    /**
     * @param EgresoTipoShortList $egresoTipos
     */
    public function setEgresoTipos(EgresoTipoShortList $egresoTipos): void
    {
        $this->egresoTipos = $egresoTipos;
    }

    /**
     * @return EgresoGroupTipoFechaShortList
     */
    public function getEgresoTotal(): EgresoGroupTipoFechaShortList
    {
        return $this->egresoTotal;
    }

    /**
     * @param EgresoGroupTipoFechaShortList $egresoTotal
     */
    public function setEgresoTotal(EgresoGroupTipoFechaShortList $egresoTotal): void
    {
        $this->egresoTotal = $egresoTotal;
    }

    /**
     * @return VehiculoShortList
     */
    public function getVehiculos(): VehiculoShortList
    {
        return $this->vehiculos;
    }

    /**
     * @param VehiculoShortList $vehiculos
     */
    public function setVehiculos(VehiculoShortList $vehiculos): void
    {
        $this->vehiculos = $vehiculos;
    }

    /**
     * @return EgresoGroupTipoFechaShortList
     */
    public function getEgresoVehiculo(): EgresoGroupTipoFechaShortList
    {
        return $this->egresoVehiculo;
    }

    /**
     * @param EgresoGroupTipoFechaShortList $egresoVehiculo
     */
    public function setEgresoVehiculo(EgresoGroupTipoFechaShortList $egresoVehiculo): void
    {
        $this->egresoVehiculo = $egresoVehiculo;
    }

    /**
     * @return BoletoInterprovincialShortFechaList
     */
    public function getIngresoTotalBoleto(): BoletoInterprovincialShortFechaList
    {
        return $this->ingresoTotalBoleto;
    }

    /**
     * @param BoletoInterprovincialShortFechaList $ingresoTotalBoleto
     */
    public function setIngresoTotalBoleto(BoletoInterprovincialShortFechaList $ingresoTotalBoleto): void
    {
        $this->ingresoTotalBoleto = $ingresoTotalBoleto;
    }

    /**
     * @return BoletoInterprovincialShortFechaList
     */
    public function getIngresoTotalBoletoPorVehiculo(): BoletoInterprovincialShortFechaList
    {
        return $this->ingresoTotalBoletoPorVehiculo;
    }

    /**
     * @param BoletoInterprovincialShortFechaList $ingresoTotalBoletoPorVehiculo
     */
    public function setIngresoTotalBoletoPorVehiculo(BoletoInterprovincialShortFechaList $ingresoTotalBoletoPorVehiculo): void
    {
        $this->ingresoTotalBoletoPorVehiculo = $ingresoTotalBoletoPorVehiculo;
    }


}
