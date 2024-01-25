<?php

namespace Src\V2\BoletoInterprovincial\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\NumericFloat;

final class BoletoInterprovincialVehiculoRangoFecha
{
    private DateFormat $fecha;
    private NumericFloat $total;

    /**
     * @param DateFormat $fecha
     * @param NumericFloat $total
     */
    public function __construct(
        DateFormat $fecha,
        NumericFloat $total
    )
    {

        $this->fecha = $fecha;
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
