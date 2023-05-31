<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class BoletoLiquidacionDiaria
{
    /**
     * @var Id
     */
    private $idRuta;
    /**
     * @var Text
     */
    private $ruta;
    /**
     * @var float|int|Numeric|string
     */
    private $numeroBoletos;
    /**
     * @var float|int|Numeric|string
     */
    private $precio;
    /**
     * @var float|int|Numeric|string
     */
    private $total;

    /**
     * LiquidacionDiaria constructor.
     * @param Id $idRuta
     * @param Text $ruta
     * @param Numeric $numeroBoletos
     * @param Numeric $precio
     * @param Numeric $total
     */
    public function __construct(
        Id $idRuta,
        Text $ruta,
        Numeric $numeroBoletos,
        Numeric $precio,
        Numeric $total
    )
    {

        $this->idRuta = $idRuta;
        $this->ruta = $ruta;
        $this->numeroBoletos = $numeroBoletos;
        $this->precio = $precio;
        $this->total = $total;
    }

    /**
     * @return Id
     */
    public function getIdRuta(): Id
    {
        return $this->idRuta;
    }

    /**
     * @param Id $idRuta
     */
    public function setIdRuta(Id $idRuta): void
    {
        $this->idRuta = $idRuta;
    }

    /**
     * @return Text
     */
    public function getRuta(): Text
    {
        return $this->ruta;
    }

    /**
     * @param Text $ruta
     */
    public function setRuta(Text $ruta): void
    {
        $this->ruta = $ruta;
    }

    /**
     * @return float|int|string
     */
    public function getNumeroBoletos()
    {
        return $this->numeroBoletos;
    }

    /**
     * @param float|int|string $numeroBoletos
     */
    public function setNumeroBoletos($numeroBoletos): void
    {
        $this->numeroBoletos = $numeroBoletos;
    }

    /**
     * @return float|int|string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param float|int|string $precio
     */
    public function setPrecio($precio): void
    {
        $this->precio = $precio;
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
