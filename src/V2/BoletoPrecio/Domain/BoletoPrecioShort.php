<?php
declare(strict_types=1);

namespace Src\V2\BoletoPrecio\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class BoletoPrecioShort
{

    private Text $paraderoOrigen;
    private Text $paraderoDestino;
    private Id $id;
    private Id $idParaderoOrigen;
    private Id $idParaderoDestino;
    private NumericFloat $precioBase;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;


    /**
     * @param Id $id
     * @param Id $idParaderoOrigen
     * @param Id $idParaderoDestino
     * @param NumericFloat $precioBase
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        Id $id,
        Id $idParaderoOrigen,
        Id $idParaderoDestino,
        NumericFloat $precioBase,

        NumericInteger $idEstado,
        NumericInteger $idEliminado
    )
    {

        $this->id = $id;
        $this->idParaderoOrigen = $idParaderoOrigen;
        $this->idParaderoDestino = $idParaderoDestino;
        $this->precioBase = $precioBase;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
    }

    /**
     * @return Text
     */
    public function getParaderoOrigen(): Text
    {
        return $this->paraderoOrigen;
    }

    /**
     * @param Text $paraderoOrigen
     */
    public function setParaderoOrigen(Text $paraderoOrigen): void
    {
        $this->paraderoOrigen = $paraderoOrigen;
    }

    /**
     * @return Text
     */
    public function getParaderoDestino(): Text
    {
        return $this->paraderoDestino;
    }

    /**
     * @param Text $paraderoDestino
     */
    public function setParaderoDestino(Text $paraderoDestino): void
    {
        $this->paraderoDestino = $paraderoDestino;
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
     * @return Id
     */
    public function getIdParaderoOrigen(): Id
    {
        return $this->idParaderoOrigen;
    }

    /**
     * @param Id $idParaderoOrigen
     */
    public function setIdParaderoOrigen(Id $idParaderoOrigen): void
    {
        $this->idParaderoOrigen = $idParaderoOrigen;
    }

    /**
     * @return Id
     */
    public function getIdParaderoDestino(): Id
    {
        return $this->idParaderoDestino;
    }

    /**
     * @param Id $idParaderoDestino
     */
    public function setIdParaderoDestino(Id $idParaderoDestino): void
    {
        $this->idParaderoDestino = $idParaderoDestino;
    }

    /**
     * @return NumericFloat
     */
    public function getPrecioBase(): NumericFloat
    {
        return $this->precioBase;
    }

    /**
     * @param NumericFloat $precioBase
     */
    public function setPrecioBase(NumericFloat $precioBase): void
    {
        $this->precioBase = $precioBase;
    }

    /**
     * @return NumericInteger
     */
    public function getIdEstado(): NumericInteger
    {
        return $this->idEstado;
    }

    /**
     * @param NumericInteger $idEstado
     */
    public function setIdEstado(NumericInteger $idEstado): void
    {
        $this->idEstado = $idEstado;
    }

    /**
     * @return NumericInteger
     */
    public function getIdEliminado(): NumericInteger
    {
        return $this->idEliminado;
    }

    /**
     * @param NumericInteger $idEliminado
     */
    public function setIdEliminado(NumericInteger $idEliminado): void
    {
        $this->idEliminado = $idEliminado;
    }


}
