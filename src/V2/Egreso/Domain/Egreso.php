<?php
declare(strict_types=1);

namespace Src\V2\Egreso\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class Egreso
{
    private Id $id;
    private NumericInteger $idOrigen;
    private Id $idCliente;
    private NumericInteger $idTipoComprobante;
    private Text $serie;
    private NumericInteger $numero;
    private Id $idCategoria;
    private Id $idTipo;
    private Text $detalle;
    private NumericInteger $idTipoDocumentoEntidad;
    private Text $numeroDocumentoEntidad;
    private Text $nombreEntidad;
    private Id $idSede;
    private NumericFloat $monto;
    private Id $idVehiculo;
    private Id $idPersonal;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idCaja;
    private Id $idCajaDiario;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;
    private NumericInteger $idMedioPago;


    //

    public Text $origen;
    public Text $tipoComprobante;
    public Text $categoria;
    public Text $tipo;
    public Text $tipoDocumentoEntidad;
    public Text $sede;
    public Text $vehiculo;
    public Text $personal;
    public Text $estado;
    public Text $caja;
    public Text $medioPago;
    public Text $usuarioRegistro;
    public Text $usuarioModifico;



    /**
     * @param Id $id
     * @param NumericInteger $idOrigen
     * @param Id $idCliente
     * @param NumericInteger $idTipoComprobante
     * @param Text $serie
     * @param NumericInteger $numero
     * @param Id $idCategoria
     * @param Id $idTipo
     * @param Text $detalle
     * @param NumericInteger $idTipoDocumentoEntidad
     * @param Text $numeroDocumentoEntidad
     * @param Text $nombreEntidad
     * @param Id $idSede
     * @param NumericFloat $monto
     * @param NumericInteger $idMedioPago
     * @param Id $idVehiculo
     * @param Id $idPersonal
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     * @param Id $idCaja
     * @param Id $idCajaDiario
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        NumericInteger $idOrigen,
        Id $idCliente,
        NumericInteger $idTipoComprobante,
        Text $serie,
        NumericInteger $numero,
        Id $idCategoria,
        Id $idTipo,
        Text $detalle,
        NumericInteger $idTipoDocumentoEntidad,
        Text $numeroDocumentoEntidad,
        Text $nombreEntidad,
        Id $idSede,
        NumericFloat $monto,
        NumericInteger $idMedioPago,
        Id $idVehiculo,
        Id $idPersonal,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
        Id $idCaja,
        Id $idCajaDiario,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->idOrigen = $idOrigen;
        $this->idCliente = $idCliente;
        $this->idTipoComprobante = $idTipoComprobante;
        $this->serie = $serie;
        $this->numero = $numero;
        $this->idCategoria = $idCategoria;
        $this->idTipo = $idTipo;
        $this->detalle = $detalle;
        $this->idTipoDocumentoEntidad = $idTipoDocumentoEntidad;
        $this->numeroDocumentoEntidad = $numeroDocumentoEntidad;
        $this->nombreEntidad = $nombreEntidad;
        $this->idSede = $idSede;
        $this->monto = $monto;
        $this->idVehiculo = $idVehiculo;
        $this->idPersonal = $idPersonal;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idCaja = $idCaja;
        $this->idCajaDiario = $idCajaDiario;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
        $this->idMedioPago = $idMedioPago;
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
    public function getIdOrigen(): NumericInteger
    {
        return $this->idOrigen;
    }

    /**
     * @param NumericInteger $idOrigen
     */
    public function setIdOrigen(NumericInteger $idOrigen): void
    {
        $this->idOrigen = $idOrigen;
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
     * @return Id
     */
    public function getIdCategoria(): Id
    {
        return $this->idCategoria;
    }

    /**
     * @param Id $idCategoria
     */
    public function setIdCategoria(Id $idCategoria): void
    {
        $this->idCategoria = $idCategoria;
    }

    /**
     * @return Id
     */
    public function getIdTipo(): Id
    {
        return $this->idTipo;
    }

    /**
     * @param Id $idTipo
     */
    public function setIdTipo(Id $idTipo): void
    {
        $this->idTipo = $idTipo;
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
     * @return NumericFloat
     */
    public function getMonto(): NumericFloat
    {
        return $this->monto;
    }

    /**
     * @param NumericFloat $monto
     */
    public function setMonto(NumericFloat $monto): void
    {
        $this->monto = $monto;
    }

    /**
     * @return Id
     */
    public function getIdVehiculo(): Id
    {
        return $this->idVehiculo;
    }

    /**
     * @param Id $idVehiculo
     */
    public function setIdVehiculo(Id $idVehiculo): void
    {
        $this->idVehiculo = $idVehiculo;
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
    public function getOrigen(): Text
    {
        return $this->origen;
    }

    /**
     * @param Text $origen
     */
    public function setOrigen(Text $origen): void
    {
        $this->origen = $origen;
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
    public function getCategoria(): Text
    {
        return $this->categoria;
    }

    /**
     * @param Text $categoria
     */
    public function setCategoria(Text $categoria): void
    {
        $this->categoria = $categoria;
    }

    /**
     * @return Text
     */
    public function getTipo(): Text
    {
        return $this->tipo;
    }

    /**
     * @param Text $tipo
     */
    public function setTipo(Text $tipo): void
    {
        $this->tipo = $tipo;
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
    public function getVehiculo(): Text
    {
        return $this->vehiculo;
    }

    /**
     * @param Text $vehiculo
     */
    public function setVehiculo(Text $vehiculo): void
    {
        $this->vehiculo = $vehiculo;
    }

    /**
     * @return Text
     */
    public function getPersonal(): Text
    {
        return $this->personal;
    }

    /**
     * @param Text $personal
     */
    public function setPersonal(Text $personal): void
    {
        $this->personal = $personal;
    }

    /**
     * @return Text
     */
    public function getEstado(): Text
    {
        return $this->estado;
    }

    /**
     * @param Text $estado
     */
    public function setEstado(Text $estado): void
    {
        $this->estado = $estado;
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




}
