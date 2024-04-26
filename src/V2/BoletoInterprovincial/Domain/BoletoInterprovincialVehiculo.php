<?php

namespace Src\V2\BoletoInterprovincial\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class BoletoInterprovincialVehiculo
{
    private Id $idVehiculo;
    private Text $placa;
    private NumericFloat $total;

    // secondary
    private DateTimeFormat $fecha;
    private NumericInteger $totalBoletos;

    /**
     * @param Id $idVehiculo
     * @param Text $placa
     * @param NumericFloat $total
     */
    public function __construct(
        Id $idVehiculo,
        Text $placa,
        NumericFloat $total
    )
    {

        $this->idVehiculo = $idVehiculo;
        $this->placa = $placa;
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
     * @return Text
     */
    public function getPlaca(): Text
    {
        return $this->placa;
    }

    /**
     * @param Text $placa
     */
    public function setPlaca(Text $placa): void
    {
        $this->placa = $placa;
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
     * @return DateTimeFormat
     */
    public function getFecha(): DateTimeFormat
    {
        return $this->fecha;
    }

    /**
     * @param DateTimeFormat $fecha
     */
    public function setFecha(DateTimeFormat $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return NumericInteger
     */
    public function getTotalBoletos(): NumericInteger
    {
        return $this->totalBoletos;
    }

    /**
     * @param NumericInteger $totalBoletos
     */
    public function setTotalBoletos(NumericInteger $totalBoletos): void
    {
        $this->totalBoletos = $totalBoletos;
    }


}
