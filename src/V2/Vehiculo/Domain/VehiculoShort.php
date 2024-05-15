<?php
declare(strict_types=1);

namespace Src\V2\Vehiculo\Domain;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class VehiculoShort
{
    private Id $id;
    private Text $placa;
    private Text $unidad;
    private NumericInteger $numeroAsientos;

    /**
     * @param Id $id
     * @param Text $placa
     * @param Text $unidad
     * @param NumericInteger $numeroAsientos
     */
    public function __construct(
        Id $id,
        Text $placa,
        Text $unidad,
        NumericInteger $numeroAsientos
    )
    {

        $this->id = $id;
        $this->placa = $placa;
        $this->unidad = $unidad;
        $this->numeroAsientos = $numeroAsientos;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @param Id $id
     */
    public function setId(Id $id): void
    {
        $this->id = $id;
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
     * @return Text
     */
    public function getUnidad(): Text
    {
        return $this->unidad;
    }

    /**
     * @param Text $unidad
     */
    public function setUnidad(Text $unidad): void
    {
        $this->unidad = $unidad;
    }

    /**
     * @return NumericInteger
     */
    public function getNumeroAsientos(): NumericInteger
    {
        return $this->numeroAsientos;
    }

    /**
     * @param NumericInteger $numeroAsientos
     */
    public function setNumeroAsientos(NumericInteger $numeroAsientos): void
    {
        $this->numeroAsientos = $numeroAsientos;
    }


}
