<?php
declare(strict_types=1);

namespace Src\V2\Perfil\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class Perfil
{


    private Text $usuarioModifico;
    private Text $usuarioRegistro;
    private Text $nivelUsuario;
    private Id $id;
    private Text $nombre;
    private NumericInteger $idNivelUsuario;
    private Id $idCliente;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsurioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param NumericInteger $idNivelUsuario
     * @param Id $idCliente
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     * @param Id $idUsurioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Text $nombre,
        NumericInteger $idNivelUsuario,
        Id $idCliente,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
        Id $idUsurioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->idNivelUsuario = $idNivelUsuario;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idUsurioRegistro = $idUsurioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
    }

    /**
     * @return Text
     */
    public function getUsuarioModifico(): Text
    {
        return $this->usuarioModifico;
    }

    /**
     * @param Text $usuarioModifico
     */
    public function setUsuarioModifico(Text $usuarioModifico): void
    {
        $this->usuarioModifico = $usuarioModifico;
    }

    /**
     * @return Text
     */
    public function getUsuarioRegistro(): Text
    {
        return $this->usuarioRegistro;
    }

    /**
     * @param Text $usuarioRegistro
     */
    public function setUsuarioRegistro(Text $usuarioRegistro): void
    {
        $this->usuarioRegistro = $usuarioRegistro;
    }

    /**
     * @return Text
     */
    public function getNivelUsuario(): Text
    {
        return $this->nivelUsuario;
    }

    /**
     * @param Text $nivelUsuario
     */
    public function setNivelUsuario(Text $nivelUsuario): void
    {
        $this->nivelUsuario = $nivelUsuario;
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
    public function getIdUsurioRegistro(): Id
    {
        return $this->idUsurioRegistro;
    }

    /**
     * @param Id $idUsurioRegistro
     */
    public function setIdUsurioRegistro(Id $idUsurioRegistro): void
    {
        $this->idUsurioRegistro = $idUsurioRegistro;
    }

    /**
     * @return Id
     */
    public function getIdUsuarioModifico(): Id
    {
        return $this->idUsuarioModifico;
    }

    /**
     * @param Id $idUsuarioModifico
     */
    public function setIdUsuarioModifico(Id $idUsuarioModifico): void
    {
        $this->idUsuarioModifico = $idUsuarioModifico;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFechaRegistro(): DateTimeFormat
    {
        return $this->fechaRegistro;
    }

    /**
     * @param DateTimeFormat $fechaRegistro
     */
    public function setFechaRegistro(DateTimeFormat $fechaRegistro): void
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFechaModifico(): DateTimeFormat
    {
        return $this->fechaModifico;
    }

    /**
     * @param DateTimeFormat $fechaModifico
     */
    public function setFechaModifico(DateTimeFormat $fechaModifico): void
    {
        $this->fechaModifico = $fechaModifico;
    }


}
