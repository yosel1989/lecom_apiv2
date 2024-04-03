<?php
declare(strict_types=1);

namespace Src\V2\MedioPago\Domain;


final class MedioPagoFlujo
{
    private MedioPagoShortList $ingresos;
    private MedioPagoShortList $egresos;

    /**
     * @param MedioPagoShortList $ingresos
     * @param MedioPagoShortList $egresos
     */
    public function __construct(
        MedioPagoShortList $ingresos,
        MedioPagoShortList $egresos,
    )
    {
        $this->ingresos = $ingresos;
        $this->egresos = $egresos;
    }

    /**
     * @return MedioPagoShortList
     */
    public function getIngresos(): MedioPagoShortList
    {
        return $this->ingresos;
    }

    /**
     * @param MedioPagoShortList $ingresos
     */
    public function setIngresos(MedioPagoShortList $ingresos): void
    {
        $this->ingresos = $ingresos;
    }

    /**
     * @return MedioPagoShortList
     */
    public function getEgresos(): MedioPagoShortList
    {
        return $this->egresos;
    }

    /**
     * @param MedioPagoShortList $egresos
     */
    public function setEgresos(MedioPagoShortList $egresos): void
    {
        $this->egresos = $egresos;
    }


}
