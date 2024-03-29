<?php
declare(strict_types=1);

namespace Src\V2\Liquidacion\Domain;


use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialShortFechaList;
use Src\V2\Egreso\Domain\EgresoGroupTipoFechaShortList;
use Src\V2\EgresoTipo\Domain\EgresoTipoShortList;
use Src\V2\Vehiculo\Domain\VehiculoShortList;

final class LiquidacionExcel
{
    private \DatePeriod $fechaPeriodo;
    private EgresoTipoShortList $egresoTipos;
    private EgresoGroupTipoFechaShortList $egresoTotal;
    private EgresoGroupTipoFechaShortList $egresoVehiculo;
    private BoletoInterprovincialShortFechaList $ingresoTotalBoleto;
    private array $egresoTotalPorVehiculo;
    private array $ingresoTotalBoletoPorVehiculo;
    private VehiculoShortList $vehiculos;
    private Id $idCliente;
    private DateFormat $fechaDesde;
    private DateFormat $fechaHasta;
    private NumericInteger $codigo;

    /**
     * @param NumericInteger $codigo
     * @param Id $idCliente
     * @param DateFormat $fechaDesde
     * @param DateFormat $fechaHasta
     * @param \DatePeriod $fechaPeriodo
     * @param EgresoTipoShortList $egresoTipos
     * @param EgresoGroupTipoFechaShortList $egresoTotal
     * @param EgresoGroupTipoFechaShortList $egresoVehiculo
     * @param BoletoInterprovincialShortFechaList $ingresoTotalBoleto
     * @param array $egresoTotalPorVehiculo
     * @param array $ingresoTotalBoletoPorVehiculo
     * @param VehiculoShortList $vehiculos
     */
    public function __construct(
        NumericInteger $codigo,
        Id $idCliente,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta,
        \DatePeriod $fechaPeriodo,
        EgresoTipoShortList $egresoTipos,
        EgresoGroupTipoFechaShortList $egresoTotal,
        EgresoGroupTipoFechaShortList $egresoVehiculo,
        BoletoInterprovincialShortFechaList $ingresoTotalBoleto,
        array $egresoTotalPorVehiculo,
        array $ingresoTotalBoletoPorVehiculo,
        VehiculoShortList $vehiculos
    )
    {

        $this->fechaPeriodo = $fechaPeriodo;
        $this->egresoTipos = $egresoTipos;
        $this->egresoTotal = $egresoTotal;
        $this->egresoVehiculo = $egresoVehiculo;
        $this->ingresoTotalBoleto = $ingresoTotalBoleto;
        $this->egresoTotalPorVehiculo = $egresoTotalPorVehiculo;
        $this->ingresoTotalBoletoPorVehiculo = $ingresoTotalBoletoPorVehiculo;
        $this->vehiculos = $vehiculos;
        $this->idCliente = $idCliente;
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;
        $this->codigo = $codigo;
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
     * @return array
     */
    public function getEgresoTotalPorVehiculo(): array
    {
        return $this->egresoTotalPorVehiculo;
    }

    /**
     * @param array $egresoTotalPorVehiculo
     */
    public function setEgresoTotalPorVehiculo(array $egresoTotalPorVehiculo): void
    {
        $this->egresoTotalPorVehiculo = $egresoTotalPorVehiculo;
    }

    /**
     * @return array
     */
    public function getIngresoTotalBoletoPorVehiculo(): array
    {
        return $this->ingresoTotalBoletoPorVehiculo;
    }

    /**
     * @param array $ingresoTotalBoletoPorVehiculo
     */
    public function setIngresoTotalBoletoPorVehiculo(array $ingresoTotalBoletoPorVehiculo): void
    {
        $this->ingresoTotalBoletoPorVehiculo = $ingresoTotalBoletoPorVehiculo;
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
     * @return NumericInteger
     */
    public function getCodigo(): NumericInteger
    {
        return $this->codigo;
    }

    /**
     * @param NumericInteger $codigo
     */
    public function setCodigo(NumericInteger $codigo): void
    {
        $this->codigo = $codigo;
    }


}
