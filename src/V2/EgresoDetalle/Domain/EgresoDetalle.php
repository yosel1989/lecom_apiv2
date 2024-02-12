<?php
declare(strict_types=1);

namespace Src\V2\EgresoDetalle\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class EgresoDetalle
{
    private Id $idEgreso;
    private Id $idCliente;
    private Id $idEgresoTipo;
    private DateFormat $fecha;
    private NumericFloat $importe;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    private Text $egresoTipo;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;
    private Text $detalle;
    private Text $numeroDocumento;
    private Id $idLiquidacion;
    private Id $id;

    /**
     * @param Id $id
     * @param Id $idEgreso
     * @param Id $idCliente
     * @param Id $idEgresoTipo
     * @param Text $detalle
     * @param DateFormat $fecha
     * @param NumericFloat $importe
     * @param Text $numeroDocumento
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     * @param Id $idLiquidacion
     */
    public function __construct(
        Id $id,
        Id $idEgreso,
        Id $idCliente,
        Id $idEgresoTipo,
        Text $detalle,
        DateFormat $fecha,
        NumericFloat $importe,
        Text $numeroDocumento,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico,
        Id $idLiquidacion
    )
    {
        $this->idEgreso = $idEgreso;
        $this->idEgresoTipo = $idEgresoTipo;
        $this->fecha = $fecha;
        $this->importe = $importe;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
        $this->idCliente = $idCliente;
        $this->detalle = $detalle;
        $this->numeroDocumento = $numeroDocumento;
        $this->idLiquidacion = $idLiquidacion;
        $this->id = $id;
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
     * @return Id
     */
    public function getIdEgreso(): Id
    {
        return $this->idEgreso;
    }

    /**
     * @param Id $idEgreso
     */
    public function setIdEgreso(Id $idEgreso): void
    {
        $this->idEgreso = $idEgreso;
    }

    /**
     * @return Id
     */
    public function getIdEgresoTipo(): Id
    {
        return $this->idEgresoTipo;
    }

    /**
     * @param Id $idEgresoTipo
     */
    public function setIdEgresoTipo(Id $idEgresoTipo): void
    {
        $this->idEgresoTipo = $idEgresoTipo;
    }

    /**
     * @return DateFormat
     */
    public function getFecha(): DateFormat
    {
        return $this->fecha;
    }

    /**
     * @param DateFormat $fecha
     */
    public function setFecha(DateFormat $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return NumericFloat
     */
    public function getImporte(): NumericFloat
    {
        return $this->importe;
    }

    /**
     * @param NumericFloat $importe
     */
    public function setImporte(NumericFloat $importe): void
    {
        $this->importe = $importe;
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
    public function getEgresoTipo(): Text
    {
        return $this->egresoTipo;
    }

    /**
     * @param Text $egresoTipo
     */
    public function setEgresoTipo(Text $egresoTipo): void
    {
        $this->egresoTipo = $egresoTipo;
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
     * @return Text
     */
    public function getDetalle(): Text
    {
        return $this->detalle;
    }

    /**
     * @param Text $detalle
     */
    public function setDetalle(Text $detalle): void
    {
        $this->detalle = $detalle;
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
     * @return Id
     */
    public function getIdLiquidacion(): Id
    {
        return $this->idLiquidacion;
    }

    /**
     * @param Id $idLiquidacion
     */
    public function setIdLiquidacion(Id $idLiquidacion): void
    {
        $this->idLiquidacion = $idLiquidacion;
    }



}
