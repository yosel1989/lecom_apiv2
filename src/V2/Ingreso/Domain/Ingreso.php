<?php
declare(strict_types=1);

namespace Src\V2\Ingreso\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class Ingreso
{
    private Id $id;
    private Id $idCliente;
    private Id $idSede;
    private NumericInteger $idTipoComprobante;
    private Text $serie;
    private NumericInteger $numero;
    private NumericInteger $idTipoIngreso;
    private Text $detalle;
    private NumericInteger $idTipoDocumentoEntidad;
    private Text $numeroDocumentoEntidad;
    private Text $nombreEntidad;
    private NumericFloat $importe;
    private Id $idCaja;
    private Id $idCajaDiario;
    private ValueBoolean $contabilizado;
    private ValueBoolean $aprobado;
    private NumericInteger $idMedioPago;
    private Text $numeroOperacion;
    private NumericInteger $idEntidadFinanciera;
    private NumericInteger $idEstado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;


    // secondary
    private Text $sede;
    private Text $tipoComprobante;
    private Text $tipoIngreso;
    private Text $tipoDocumentoEntidad;
    private Text $caja;
    private Text $medioPago;
    private Text $entidadFinanciera;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;

    /**
     * @param Id $id
     * @param Id $idCliente
     * @param Id $idSede
     * @param NumericInteger $idTipoComprobante
     * @param Text $serie
     * @param NumericInteger $numero
     * @param NumericInteger $idTipoIngreso
     * @param Text $detalle
     * @param NumericInteger $idTipoDocumentoEntidad
     * @param Text $numeroDocumentoEntidad
     * @param Text $nombreEntidad
     * @param NumericFloat $importe
     * @param Id $idCaja
     * @param Id $idCajaDiario
     * @param ValueBoolean $contabilizado
     * @param ValueBoolean $aprobado
     * @param NumericInteger $idMedioPago
     * @param Text $numeroOperacion
     * @param NumericInteger $idEntidadFinanciera
     * @param NumericInteger $idEstado
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idTipoComprobante,
        Text $serie,
        NumericInteger $numero,
        NumericInteger $idTipoIngreso,
        Text $detalle,
        NumericInteger $idTipoDocumentoEntidad,
        Text $numeroDocumentoEntidad,
        Text $nombreEntidad,
        NumericFloat $importe,

        Id $idCaja,
        Id $idCajaDiario,
        ValueBoolean $contabilizado,
        ValueBoolean $aprobado,
        NumericInteger $idMedioPago,
        Text $numeroOperacion,
        NumericInteger $idEntidadFinanciera,

        NumericInteger $idEstado,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->idSede = $idSede;
        $this->idTipoComprobante = $idTipoComprobante;
        $this->serie = $serie;
        $this->numero = $numero;
        $this->idTipoIngreso = $idTipoIngreso;
        $this->detalle = $detalle;
        $this->idTipoDocumentoEntidad = $idTipoDocumentoEntidad;
        $this->numeroDocumentoEntidad = $numeroDocumentoEntidad;
        $this->nombreEntidad = $nombreEntidad;
        $this->importe = $importe;
        $this->idCaja = $idCaja;
        $this->idCajaDiario = $idCajaDiario;
        $this->contabilizado = $contabilizado;
        $this->aprobado = $aprobado;
        $this->idMedioPago = $idMedioPago;
        $this->numeroOperacion = $numeroOperacion;
        $this->idEntidadFinanciera = $idEntidadFinanciera;
        $this->idEstado = $idEstado;
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
     * @return Text
     */
    public function getSerie(): Text
    {
        return $this->serie;
    }

    /**
     * @param Text $serie
     */
    public function setSerie(Text $serie): void
    {
        $this->serie = $serie;
    }

    /**
     * @return NumericInteger
     */
    public function getNumero(): NumericInteger
    {
        return $this->numero;
    }

    /**
     * @param NumericInteger $numero
     */
    public function setNumero(NumericInteger $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoIngreso(): NumericInteger
    {
        return $this->idTipoIngreso;
    }

    /**
     * @param NumericInteger $idTipoIngreso
     */
    public function setIdTipoIngreso(NumericInteger $idTipoIngreso): void
    {
        $this->idTipoIngreso = $idTipoIngreso;
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
     * @return NumericInteger
     */
    public function getIdTipoDocumentoEntidad(): NumericInteger
    {
        return $this->idTipoDocumentoEntidad;
    }

    /**
     * @param NumericInteger $idTipoDocumentoEntidad
     */
    public function setIdTipoDocumentoEntidad(NumericInteger $idTipoDocumentoEntidad): void
    {
        $this->idTipoDocumentoEntidad = $idTipoDocumentoEntidad;
    }

    /**
     * @return Text
     */
    public function getNumeroDocumentoEntidad(): Text
    {
        return $this->numeroDocumentoEntidad;
    }

    /**
     * @param Text $numeroDocumentoEntidad
     */
    public function setNumeroDocumentoEntidad(Text $numeroDocumentoEntidad): void
    {
        $this->numeroDocumentoEntidad = $numeroDocumentoEntidad;
    }

    /**
     * @return Text
     */
    public function getNombreEntidad(): Text
    {
        return $this->nombreEntidad;
    }

    /**
     * @param Text $nombreEntidad
     */
    public function setNombreEntidad(Text $nombreEntidad): void
    {
        $this->nombreEntidad = $nombreEntidad;
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
     * @return Id
     */
    public function getIdCaja(): Id
    {
        return $this->idCaja;
    }

    /**
     * @param Id $idCaja
     */
    public function setIdCaja(Id $idCaja): void
    {
        $this->idCaja = $idCaja;
    }

    /**
     * @return Id
     */
    public function getIdCajaDiario(): Id
    {
        return $this->idCajaDiario;
    }

    /**
     * @param Id $idCajaDiario
     */
    public function setIdCajaDiario(Id $idCajaDiario): void
    {
        $this->idCajaDiario = $idCajaDiario;
    }

    /**
     * @return ValueBoolean
     */
    public function getContabilizado(): ValueBoolean
    {
        return $this->contabilizado;
    }

    /**
     * @param ValueBoolean $contabilizado
     */
    public function setContabilizado(ValueBoolean $contabilizado): void
    {
        $this->contabilizado = $contabilizado;
    }

    /**
     * @return ValueBoolean
     */
    public function getAprobado(): ValueBoolean
    {
        return $this->aprobado;
    }

    /**
     * @param ValueBoolean $aprobado
     */
    public function setAprobado(ValueBoolean $aprobado): void
    {
        $this->aprobado = $aprobado;
    }

    /**
     * @return NumericInteger
     */
    public function getIdMedioPago(): NumericInteger
    {
        return $this->idMedioPago;
    }

    /**
     * @param NumericInteger $idMedioPago
     */
    public function setIdMedioPago(NumericInteger $idMedioPago): void
    {
        $this->idMedioPago = $idMedioPago;
    }

    /**
     * @return Text
     */
    public function getNumeroOperacion(): Text
    {
        return $this->numeroOperacion;
    }

    /**
     * @param Text $numeroOperacion
     */
    public function setNumeroOperacion(Text $numeroOperacion): void
    {
        $this->numeroOperacion = $numeroOperacion;
    }

    /**
     * @return NumericInteger
     */
    public function getIdEntidadFinanciera(): NumericInteger
    {
        return $this->idEntidadFinanciera;
    }

    /**
     * @param NumericInteger $idEntidadFinanciera
     */
    public function setIdEntidadFinanciera(NumericInteger $idEntidadFinanciera): void
    {
        $this->idEntidadFinanciera = $idEntidadFinanciera;
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
    public function getTipoIngreso(): Text
    {
        return $this->tipoIngreso;
    }

    /**
     * @param Text $tipoIngreso
     */
    public function setTipoIngreso(Text $tipoIngreso): void
    {
        $this->tipoIngreso = $tipoIngreso;
    }

    /**
     * @return Text
     */
    public function getTipoDocumentoEntidad(): Text
    {
        return $this->tipoDocumentoEntidad;
    }

    /**
     * @param Text $tipoDocumentoEntidad
     */
    public function setTipoDocumentoEntidad(Text $tipoDocumentoEntidad): void
    {
        $this->tipoDocumentoEntidad = $tipoDocumentoEntidad;
    }

    /**
     * @return Text
     */
    public function getCaja(): Text
    {
        return $this->caja;
    }

    /**
     * @param Text $caja
     */
    public function setCaja(Text $caja): void
    {
        $this->caja = $caja;
    }

    /**
     * @return Text
     */
    public function getMedioPago(): Text
    {
        return $this->medioPago;
    }

    /**
     * @param Text $medioPago
     */
    public function setMedioPago(Text $medioPago): void
    {
        $this->medioPago = $medioPago;
    }

    /**
     * @return Text
     */
    public function getEntidadFinanciera(): Text
    {
        return $this->entidadFinanciera;
    }

    /**
     * @param Text $entidadFinanciera
     */
    public function setEntidadFinanciera(Text $entidadFinanciera): void
    {
        $this->entidadFinanciera = $entidadFinanciera;
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
