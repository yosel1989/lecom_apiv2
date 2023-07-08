<?php
declare(strict_types=1);

namespace Src\V2\Perfil\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class PerfilShort
{
    private Id $id;
    private Text $nombre;
    private NumericInteger $idNivelUsuario;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param NumericInteger $idNivelUsuario
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        NumericInteger $idNivelUsuario,
        NumericInteger $idEstado,
        NumericInteger $idEliminado
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->idNivelUsuario = $idNivelUsuario;
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
     * @return NumericInteger
     */
    public function getIdNivelUsuario(): NumericInteger
    {
        return $this->idNivelUsuario;
    }

    /**
     * @param NumericInteger $idNivelUsuario
     */
    public function setIdNivelUsuario(NumericInteger $idNivelUsuario): void
    {
        $this->idNivelUsuario = $idNivelUsuario;
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
