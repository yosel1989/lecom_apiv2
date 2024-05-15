<?php
declare(strict_types=1);

namespace Src\V2\ClienteMedioPago\Domain;


final class ClienteMedioPagoFlujo
{
    private ClienteMedioPagoShortList $ingresos;
    private ClienteMedioPagoShortList $egresos;

    /**
     * @param ClienteMedioPagoShortList $ingresos
     * @param ClienteMedioPagoShortList $egresos
     */
    public function __construct(
        ClienteMedioPagoShortList $ingresos,
        ClienteMedioPagoShortList $egresos,
    )
    {
        $this->ingresos = $ingresos;
        $this->egresos = $egresos;
    }

    /**
     * @return ClienteMedioPagoShortList
     */
    public function getIngresos(): ClienteMedioPagoShortList
    {
        return $this->ingresos;
    }

    /**
     * @param ClienteMedioPagoShortList $ingresos
     */
    public function setIngresos(ClienteMedioPagoShortList $ingresos): void
    {
        $this->ingresos = $ingresos;
    }

    /**
     * @return ClienteMedioPagoShortList
     */
    public function getEgresos(): ClienteMedioPagoShortList
    {
        return $this->egresos;
    }

    /**
     * @param ClienteMedioPagoShortList $egresos
     */
    public function setEgresos(ClienteMedioPagoShortList $egresos): void
    {
        $this->egresos = $egresos;
    }


}
