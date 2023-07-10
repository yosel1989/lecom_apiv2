<?php
declare(strict_types=1);

namespace Src\V2\Modulo\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class ModuloShort
{
    private Id $id;
    private Text $nombre;
    private Text $icono;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param Text $icono
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Text $icono,
        NumericInteger $idEstado,
        NumericInteger $idEliminado
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->icono = $icono;
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
     * @return Text
     */
    public function getIcono(): Text
    {
        return $this->icono;
    }

    /**
     * @param Text $icono
     */
    public function setIcono(Text $icono): void
    {
        $this->icono = $icono;
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
