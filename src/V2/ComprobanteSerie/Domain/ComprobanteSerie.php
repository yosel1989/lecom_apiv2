<?php
declare(strict_types=1);

namespace Src\V2\ComprobanteSerie\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class ComprobanteSerie
{
    private Id $id;
    private NumericInteger $idTipoComprobante;
    private Id $idCliente;
    private Id $idSede;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;
    private NumericInteger $idEstado;

    private Text $sede;
    private Text $tipoComprobante;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;
    private Text $nombre;

    /**
     * @param Id $id
     * @param NumericInteger $idTipoComprobante
     * @param Text $nombre
     * @param Id $idCliente
     * @param Id $idSede
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     * @param NumericInteger $idEstado
     */
    public function __construct(
        Id             $id,
        NumericInteger $idTipoComprobante,
        Text $nombre,
        Id             $idCliente,
        Id             $idSede,
        Id             $idUsuarioRegistro,
        Id             $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico,
        NumericInteger $idEstado
    )
    {

        $this->id = $id;
        $this->idTipoComprobante = $idTipoComprobante;
        $this->idCliente = $idCliente;
        $this->idSede = $idSede;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
        $this->idEstado = $idEstado;
        $this->nombre = $nombre;
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
    public function getIdTipoComprobante(): NumericInteger
    {
        return $this->idTipoComprobante;
    }

    /**
     * @param NumericInteger $idTipoComprobante
     */
    public function setIdTipoComprobante(NumericInteger $idTipoComprobante): void
    {
        $this->idTipoComprobante = $idTipoComprobante;
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
     * @return Text
     */
    public function getSede(): Text
    {
        return $this->sede;
    }

    /**
     * @param Text $sede
     */
    public function setSede(Text $sede): void
    {
        $this->sede = $sede;
    }

    /**
     * @return Text
     */
    public function getTipoComprobante(): Text
    {
        return $this->tipoComprobante;
    }

    /**
     * @param Text $tipoComprobante
     */
    public function setTipoComprobante(Text $tipoComprobante): void
    {
        $this->tipoComprobante = $tipoComprobante;
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


}
