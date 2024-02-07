<?php
declare(strict_types=1);

namespace Src\V2\TipoComprobante\Domain;

use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class TipoComprobante
{
    private NumericInteger $id;
    private Text $nombre;
    private NumericInteger $puntoVenta;
    private ValueBoolean $blDespacho;

    /**
     * @param NumericInteger $id
     * @param Text $nombre
     * @param NumericInteger $puntoVenta
     * @param ValueBoolean $blDespacho
     */
    public function __construct(
        NumericInteger $id,
        Text $nombre,
        NumericInteger $puntoVenta,
        ValueBoolean $blDespacho
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;

        $this->puntoVenta = $puntoVenta;
        $this->blDespacho = $blDespacho;
    }

    /**
     * @return NumericInteger
     */
    public function getId(): NumericInteger
    {
        return $this->id;
    }

    /**
     * @param NumericInteger $id
     */
    public function setId(NumericInteger $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Text
     */
    public function getNombre(): Text
    {
        return $this->nombre;
    }

    /**
     * @param Text $nombre
     */
    public function setNombre(Text $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return NumericInteger
     */
    public function getPuntoVenta(): NumericInteger
    {
        return $this->puntoVenta;
    }

    /**
     * @param NumericInteger $puntoVenta
     */
    public function setPuntoVenta(NumericInteger $puntoVenta): void
    {
        $this->puntoVenta = $puntoVenta;
    }

    /**
     * @return ValueBoolean
     */
    public function getBlDespacho(): ValueBoolean
    {
        return $this->blDespacho;
    }

    /**
     * @param ValueBoolean $blDespacho
     */
    public function setBlDespacho(ValueBoolean $blDespacho): void
    {
        $this->blDespacho = $blDespacho;
    }

}
