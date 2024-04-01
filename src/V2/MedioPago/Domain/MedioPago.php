<?php
declare(strict_types=1);

namespace Src\V2\MedioPago\Domain;

use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class MedioPago
{
    private NumericInteger $id;
    private Text $nombre;
    private ValueBoolean $blDespacho;
    private ValueBoolean $blEntidadFinanciera;

    // secondary
    private NumericFloat $monto;

    /**
     * @param NumericInteger $id
     * @param Text $nombre
     * @param ValueBoolean $blDespacho
     * @param ValueBoolean $blEntidadFinanciera
     */
    public function __construct(
        NumericInteger $id,
        Text $nombre,
        ValueBoolean $blDespacho,
        ValueBoolean $blEntidadFinanciera,
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->blDespacho = $blDespacho;
        $this->blEntidadFinanciera = $blEntidadFinanciera;
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

    /**
     * @return ValueBoolean
     */
    public function getBlEntidadFinanciera(): ValueBoolean
    {
        return $this->blEntidadFinanciera;
    }

    /**
     * @param ValueBoolean $blEntidadFinanciera
     */
    public function setBlEntidadFinanciera(ValueBoolean $blEntidadFinanciera): void
    {
        $this->blEntidadFinanciera = $blEntidadFinanciera;
    }

    /**
     * @return NumericFloat
     */
    public function getMonto(): NumericFloat
    {
        return $this->monto;
    }

    /**
     * @param NumericFloat $monto
     */
    public function setMonto(NumericFloat $monto): void
    {
        $this->monto = $monto;
    }



}
