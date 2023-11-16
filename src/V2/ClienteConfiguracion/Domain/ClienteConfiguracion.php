<?php
declare(strict_types=1);

namespace Src\V2\ClienteConfiguracion\Domain;

use Src\Core\Domain\ValueObjects\Text;

final class ClienteConfiguracion
{
    private Text $ruc;
    private Text $direccionFiscal;
    private Text $razonSocial;

    /**
     * @param Text $ruc
     * @param Text $direccionFiscal
     * @param Text $razonSocial
     */
    public function __construct(
        Text $ruc,
        Text $direccionFiscal,
        Text $razonSocial
    )
    {

        $this->ruc = $ruc;
        $this->direccionFiscal = $direccionFiscal;
        $this->razonSocial = $razonSocial;
    }

    /**
     * @return Text
     */
    public function getRuc(): Text
    {
        return $this->ruc;
    }

    /**
     * @param Text $ruc
     */
    public function setRuc(Text $ruc): void
    {
        $this->ruc = $ruc;
    }

    /**
     * @return Text
     */
    public function getDireccionFiscal(): Text
    {
        return $this->direccionFiscal;
    }

    /**
     * @param Text $direccionFiscal
     */
    public function setDireccionFiscal(Text $direccionFiscal): void
    {
        $this->direccionFiscal = $direccionFiscal;
    }

    /**
     * @return Text
     */
    public function getRazonSocial(): Text
    {
        return $this->razonSocial;
    }

    /**
     * @param Text $razonSocial
     */
    public function setRazonSocial(Text $razonSocial): void
    {
        $this->razonSocial = $razonSocial;
    }



}
