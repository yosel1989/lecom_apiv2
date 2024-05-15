<?php
declare(strict_types=1);

namespace Src\V2\Personal\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class PersonalShort
{
    private Id $id;
    private Text $nombre;
    private Text $apellido;
    private Id $idCliente;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idSede;

    // secondary
    private Text $tipoPersonal;
    private Text $foto;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param Text $apellido
     * @param Id $idCliente
     * @param Id $idSede
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Text $apellido,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idSede = $idSede;
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
    public function getApellido(): Text
    {
        return $this->apellido;
    }

    /**
     * @param Text $apellido
     */
    public function setApellido(Text $apellido): void
    {
        $this->apellido = $apellido;
    }

    /**
     * @return Id
     */
    public function getIdCliente(): Id
    {
        return $this->idCliente;
    }

    /**
     * @param Id $idCliente
     */
    public function setIdCliente(Id $idCliente): void
    {
        $this->idCliente = $idCliente;
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
    public function getTipoPersonal(): Text
    {
        return $this->tipoPersonal;
    }

    /**
     * @param Text $tipoPersonal
     */
    public function setTipoPersonal(Text $tipoPersonal): void
    {
        $this->tipoPersonal = $tipoPersonal;
    }

    /**
     * @return Text
     */
    public function getFoto(): Text
    {
        return $this->foto;
    }

    /**
     * @param Text $foto
     */
    public function setFoto(Text $foto): void
    {
        $this->foto = $foto;
    }




}
