<?php
declare(strict_types=1);

namespace Src\V2\Cliente\Domain;

use Illuminate\Support\Facades\Date;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class Cliente
{
    private Id $id;
    private NumericInteger $codigo;
    private Id $idTipoDocumento;
    private Text $numeroDocumento;
    private Text $nombre;
    private Text $nombreContacto;
    private Text $correo;
    private Text $direccion;
    private Text $telefono1;
    private Text $telefono2;
    private NumericInteger $idTipo;
    private Id $idCliente;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    private Text $tipoDocumento;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;


    /**
     * @param Id $id
     * @param NumericInteger $codigo
     * @param Id $idTipoDocumento
     * @param Text $numeroDocumento
     * @param Text $nombre
     * @param Text $nombreContacto
     * @param Text $correo
     * @param Text $direccion
     * @param Text $telefono1
     * @param Text $telefono2
     * @param NumericInteger $idTipo
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
        NumericInteger $codigo,
        Id $idTipoDocumento,
        Text $numeroDocumento,
        Text $nombre,
        Text $nombreContacto,
        Text $correo,
        Text $direccion,
        Text $telefono1,
        Text $telefono2,
        NumericInteger $idTipo,
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
        $this->codigo = $codigo;
        $this->idTipoDocumento = $idTipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
        $this->nombre = $nombre;
        $this->nombreContacto = $nombreContacto;
        $this->correo = $correo;
        $this->direccion = $direccion;
        $this->telefono1 = $telefono1;
        $this->telefono2 = $telefono2;
        $this->idTipo = $idTipo;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
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
     * @return NumericInteger
     */
    public function getCodigo(): NumericInteger
    {
        return $this->codigo;
    }

    /**
     * @param NumericInteger $codigo
     */
    public function setCodigo(NumericInteger $codigo): void
    {
        $this->codigo = $codigo;
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
    public function getNombreContacto(): Text
    {
        return $this->nombreContacto;
    }

    /**
     * @param Text $nombreContacto
     */
    public function setNombreContacto(Text $nombreContacto): void
    {
        $this->nombreContacto = $nombreContacto;
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
     * @return Text
     */
    public function getDireccion(): Text
    {
        return $this->direccion;
    }

    /**
     * @param Text $direccion
     */
    public function setDireccion(Text $direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return Text
     */
    public function getTelefono1(): Text
    {
        return $this->telefono1;
    }

    /**
     * @param Text $telefono1
     */
    public function setTelefono1(Text $telefono1): void
    {
        $this->telefono1 = $telefono1;
    }

    /**
     * @return Text
     */
    public function getTelefono2(): Text
    {
        return $this->telefono2;
    }

    /**
     * @param Text $telefono2
     */
    public function setTelefono2(Text $telefono2): void
    {
        $this->telefono2 = $telefono2;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipo(): NumericInteger
    {
        return $this->idTipo;
    }

    /**
     * @param NumericInteger $idTipo
     */
    public function setIdTipo(NumericInteger $idTipo): void
    {
        $this->idTipo = $idTipo;
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

    /**
     * @return Text
     */
    public function getTipoDocumento(): Text
    {
        return $this->tipoDocumento;
    }

    /**
     * @param Text $tipoDocumento
     */
    public function setTipoDocumento(Text $tipoDocumento): void
    {
        $this->tipoDocumento = $tipoDocumento;
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
