<?php

declare(strict_types=1);

namespace Src\Administracion\Egreso\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class LiquidacionDiaria
{
    /**
     * @var Id
     */
    private $idTipoEgreso;
    /**
     * @var Text
     */
    private $tipoEgreso;
    /**
     * @var float|int|Numeric|string
     */
    private $total;

    /**
     * LiquidacionDiaria constructor.
     * @param Id $idTipoEgreso
     * @param Text $tipoEgreso
     * @param Numeric $total
     */
    public function __construct(
        Id $idTipoEgreso,
        Text $tipoEgreso,
        Numeric $total
    )
    {
        $this->idTipoEgreso = $idTipoEgreso;
        $this->tipoEgreso = $tipoEgreso;
        $this->total = $total;
    }

    /**
     * @return Id
     */
    public function getIdTipoEgreso(): Id
    {
        return $this->idTipoEgreso;
    }

    /**
     * @param Id $idTipoEgreso
     */
    public function setIdTipoEgreso(Id $idTipoEgreso): void
    {
        $this->idTipoEgreso = $idTipoEgreso;
    }

    /**
     * @return Text
     */
    public function getTipoEgreso(): Text
    {
        return $this->tipoEgreso;
    }

    /**
     * @param Text $tipoEgreso
     */
    public function setTipoEgreso(Text $tipoEgreso): void
    {
        $this->tipoEgreso = $tipoEgreso;
    }

    /**
     * @return float|int|string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float|int|string $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

}
