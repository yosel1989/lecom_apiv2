<?php
declare(strict_types=1);

namespace Src\V2\Pos\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class PosShort
{
    private Id $id;
    private Text $nombre;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idSede;
    private Text $imei;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param Text $imei
     * @param Id $idSede
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Text $imei,
        Id $idSede,
        NumericInteger $idEstado,
        NumericInteger $idEliminado
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idSede = $idSede;
        $this->imei = $imei;
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
     * @return Id
     */
    public function getIdSede(): Id
    {
        return $this->idSede;
    }

    /**
     * @param Id $idSede
     */
    public function setIdSede(Id $idSede): void
    {
        $this->idSede = $idSede;
    }

    /**
     * @return Text
     */
    public function getImei(): Text
    {
        return $this->imei;
    }

    /**
     * @param Text $imei
     */
    public function setImei(Text $imei): void
    {
        $this->imei = $imei;
    }



}
