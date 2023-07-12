<?php
declare(strict_types=1);

namespace Src\V2\Usuario\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

/**
 * @property Id idPersonalModifico
 */
final class Usuario
{
    private Id $id;
    private Text $usuario;
    private Text $nombre;
    private Text $apellido;
    private Id $idPersonal;
    private Id $idPerfil;
    private Text $perfil;
    private Text $correo;
    private Id $idCliente;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsuarioRegistro;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    private Text $usuarioRegistro;
    private Text $usuarioModifico;


    /**
     * @param Id $id
     * @param Text $usuario
     * @param Text $nombre
     * @param Text $apellido
     * @param Id $idPersonal
     * @param Id $idPerfil
     * @param Text $correo
     * @param Id $idCliente
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Text $usuario,
        Text $nombre,
        Text $apellido,
        Id $idPersonal,
        Id $idPerfil,
        Text $correo,
        Id $idCliente,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->idPersonal = $idPersonal;
        $this->idPerfil = $idPerfil;
        $this->correo = $correo;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idPersonalModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
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
    public function getUsuario(): Text
    {
        return $this->usuario;
    }

    /**
     * @param Text $usuario
     */
    public function setUsuario(Text $usuario): void
    {
        $this->usuario = $usuario;
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
    public function getIdPersonal(): Id
    {
        return $this->idPersonal;
    }

    /**
     * @param Id $idPersonal
     */
    public function setIdPersonal(Id $idPersonal): void
    {
        $this->idPersonal = $idPersonal;
    }

    /**
     * @return Id
     */
    public function getIdPerfil(): Id
    {
        return $this->idPerfil;
    }

    /**
     * @param Id $idPerfil
     */
    public function setIdPerfil(Id $idPerfil): void
    {
        $this->idPerfil = $idPerfil;
    }

    /**
     * @return Text
     */
    public function getPerfil(): Text
    {
        return $this->perfil;
    }

    /**
     * @param Text $perfil
     */
    public function setPerfil(Text $perfil): void
    {
        $this->perfil = $perfil;
    }

    /**
     * @return Text
     */
    public function getCorreo(): Text
    {
        return $this->correo;
    }

    /**
     * @param Text $correo
     */
    public function setCorreo(Text $correo): void
    {
        $this->correo = $correo;
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
    public function getIdUsuarioRegistro(): Id
    {
        return $this->idUsuarioRegistro;
    }

    /**
     * @param Id $idUsuarioRegistro
     */
    public function setIdUsuarioRegistro(Id $idUsuarioRegistro): void
    {
        $this->idUsuarioRegistro = $idUsuarioRegistro;
    }

    /**
     * @return Id
     */
    public function getIdUsuarioModifico(): Id
    {
        return $this->idPersonalModifico;
    }

    /**
     * @param Id $idUsuarioModifico
     */
    public function setIdUsuarioModifico(Id $idUsuarioModifico): void
    {
        $this->idPersonalModifico = $idUsuarioModifico;
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

}
