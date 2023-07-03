<?php
declare(strict_types=1);

namespace Src\V2\Personal\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class Personal
{

    private Text $usuarioModifico;
    private Text $usuarioRegistro;
    private Id $id;
    private Text $foto;
    private Text $nombre;
    private Text $apellido;
    private Id $idTipoDocumento;
    private Text $numeroDocumento;
    private Text $correo;
    private Id $idCliente;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsurioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    /**
     * @param Id $id
     * @param Text $foto
     * @param Text $nombre
     * @param Text $apellido
     * @param Id $idTipoDocumento
     * @param Text $numeroDocumento
     * @param Text $correo
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
        Text $foto,
        Text $nombre,
        Text $apellido,
        Id $idTipoDocumento,
        Text $numeroDocumento,
        Text $correo,
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
        $this->foto = $foto;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->idTipoDocumento = $idTipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
        $this->correo = $correo;
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
    public function getIdTipoDocumento(): Id
    {
        return $this->idTipoDocumento;
    }

    /**
     * @param Id $idTipoDocumento
     */
    public function setIdTipoDocumento(Id $idTipoDocumento): void
    {
        $this->idTipoDocumento = $idTipoDocumento;
    }

    /**
     * @return Text
     */
    public function getNumeroDocumento(): Text
    {
        return $this->numeroDocumento;
    }

    /**
     * @param Text $numeroDocumento
     */
    public function setNumeroDocumento(Text $numeroDocumento): void
    {
        $this->numeroDocumento = $numeroDocumento;
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
