<?php
declare(strict_types=1);

namespace Src\V2\Sede\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class SedeShort
{
    private Id $id;
    private Text $nombre;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Text $codigo;

    private ValueBoolean $selected;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param Text $codigo
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Text $codigo,
        NumericInteger $idEstado,
        NumericInteger $idEliminado
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->codigo = $codigo;
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
     * @return Text
     */
    public function getCodigo(): Text
    {
        return $this->codigo;
    }

    /**
     * @param Text $codigo
     */
    public function setCodigo(Text $codigo): void
    {
        $this->codigo = $codigo;
    }

    /**
     * @return ValueBoolean
     */
    public function getSelected(): ValueBoolean
    {
        return $this->selected;
    }

    /**
     * @param ValueBoolean $selected
     */
    public function setSelected(ValueBoolean $selected): void
    {
        $this->selected = $selected;
    }



}
