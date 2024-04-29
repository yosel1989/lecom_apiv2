<?php
declare(strict_types=1);

namespace Src\V2\Empresa\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class Empresa
{
    private Id $id;
    private Text $nombre;
    private Text $ruc;
    private Text $direccion;
    private Text $idUbigeo;
    private Id $idCliente;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    // secondary
    private Text $usuarioRegistro;
    private Text $usuarioModifico;
    private Text $departamento;
    private Text $provincia;
    private Text $distrito;
    private ValueBoolean $predeterminado;


    /**
     * @param Id $id
     * @param Text $nombre
     * @param Text $ruc
     * @param Text $direccion
     * @param Text $idUbigeo
     * @param Id $idCliente
     * @param ValueBoolean $predeterminado
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Text $ruc,
        Text $direccion,
        Text $idUbigeo,
        Id $idCliente,
        ValueBoolean $predeterminado,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->ruc = $ruc;
        $this->direccion = $direccion;
        $this->idUbigeo = $idUbigeo;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
        $this->predeterminado = $predeterminado;
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

    /**
     * @return Text
     */
    public function getDepartamento(): Text
    {
        return $this->departamento;
    }

    /**
     * @param Text $departamento
     */
    public function setDepartamento(Text $departamento): void
    {
        $this->departamento = $departamento;
    }

    /**
     * @return Text
     */
    public function getProvincia(): Text
    {
        return $this->provincia;
    }

    /**
     * @param Text $provincia
     */
    public function setProvincia(Text $provincia): void
    {
        $this->provincia = $provincia;
    }

    /**
     * @return Text
     */
    public function getDistrito(): Text
    {
        return $this->distrito;
    }

    /**
     * @param Text $distrito
     */
    public function setDistrito(Text $distrito): void
    {
        $this->distrito = $distrito;
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
    public function getRuc(): Text
    {
        return $this->ruc;
    }

    /**
     * @param Text $ruc
     */
    public function setRuc(Text $ruc): void
    {
        $this->ruc = $ruc;
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
    public function getIdUbigeo(): Text
    {
        return $this->idUbigeo;
    }

    /**
     * @param Text $idUbigeo
     */
    public function setIdUbigeo(Text $idUbigeo): void
    {
        $this->idUbigeo = $idUbigeo;
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
     * @return ValueBoolean
     */
    public function getPredeterminado(): ValueBoolean
    {
        return $this->predeterminado;
    }

    /**
     * @param ValueBoolean $predeterminado
     */
    public function setPredeterminado(ValueBoolean $predeterminado): void
    {
        $this->predeterminado = $predeterminado;
    }


}
