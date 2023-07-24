<?php
declare(strict_types=1);

namespace Src\V2\Paradero\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class ParaderoShort
{
    private Id $id;
    private Text $nombre;
    private NumericFloat $precioBase;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idRuta;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param NumericFloat $precioBase
     * @param Id $idRuta
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        NumericFloat $precioBase,
        Id $idRuta,
        NumericInteger $idEstado,
        NumericInteger $idEliminado
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precioBase = $precioBase;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idRuta = $idRuta;
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


}
