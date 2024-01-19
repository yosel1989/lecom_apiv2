<?php
declare(strict_types=1);

namespace Src\V2\EgresoTipo\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class EgresoTipoShort
{
    private Id $id;
    private Text $nombre;
    private Id $idCategoria;
    private NumericFloat $precioBase;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;


    /**
     * @param Id $id
     * @param Text $nombre
     * @param Id $idCategoria
     * @param NumericFloat $precioBase
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Id $idCategoria,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->idCategoria = $idCategoria;
        $this->precioBase = $precioBase;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
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
     * @return Id
     */
    public function getIdCategoria(): Id
    {
        return $this->idCategoria;
    }

    /**
     * @param Id $idCategoria
     */
    public function setIdCategoria(Id $idCategoria): void
    {
        $this->idCategoria = $idCategoria;
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
