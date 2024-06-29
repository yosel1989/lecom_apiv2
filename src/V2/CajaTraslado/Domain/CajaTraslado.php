<?php
declare(strict_types=1);

namespace Src\V2\CajaTraslado\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class CajaTraslado
{

    private Id $id;
    private Id $idCliente;
    private Id $idSede;
    private NumericInteger $idTipoComprobante;
    private Text $serie;
    private NumericInteger $numero;
    private Id $idPersonal;
    private Id $idCajaOrigen;
    private Id $idCajaDiarioOrigen;
    private Id $idCajaDestino;
    private Id $idCajaDiarioDestino;
    private NumericFloat $monto;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    // secondary
    private Text $sede;
    private Text $tipoComprobante;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;
    private Text $cajaOrigen;
    private Text $cajaDestino;
    private Text $estado;
    private Text $personal;


    /**
     * @param Id $id
     * @param Id $idCliente
     * @param Id $idSede
     * @param NumericInteger $idTipoComprobante
     * @param Text $serie
     * @param NumericInteger $numero
     * @param Id $idPersonal
     * @param Id $idCajaOrigen
     * @param Id $idCajaDestino
     * @param NumericFloat $monto
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
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
        Id $idPersonal,
        Id $idCajaOrigen,
        Id $idCajaDestino,
        NumericFloat $monto,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
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
        $this->idPersonal = $idPersonal;
        $this->idCajaOrigen = $idCajaOrigen;
        $this->idCajaDestino = $idCajaDestino;
        $this->monto = $monto;
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
    public function getIdCajaOrigen(): Id
    {
        return $this->idCajaOrigen;
    }

    /**
     * @param Id $idCajaOrigen
     */
    public function setIdCajaOrigen(Id $idCajaOrigen): void
    {
        $this->idCajaOrigen = $idCajaOrigen;
    }

    /**
     * @return Id
     */
    public function getIdCajaDiarioOrigen(): Id
    {
        return $this->idCajaDiarioOrigen;
    }

    /**
     * @param Id $idCajaDiarioOrigen
     */
    public function setIdCajaDiarioOrigen(Id $idCajaDiarioOrigen): void
    {
        $this->idCajaDiarioOrigen = $idCajaDiarioOrigen;
    }

    /**
     * @return Id
     */
    public function getIdCajaDestino(): Id
    {
        return $this->idCajaDestino;
    }

    /**
     * @param Id $idCajaDestino
     */
    public function setIdCajaDestino(Id $idCajaDestino): void
    {
        $this->idCajaDestino = $idCajaDestino;
    }

    /**
     * @return Id
     */
    public function getIdCajaDiarioDestino(): Id
    {
        return $this->idCajaDiarioDestino;
    }

    /**
     * @param Id $idCajaDiarioDestino
     */
    public function setIdCajaDiarioDestino(Id $idCajaDiarioDestino): void
    {
        $this->idCajaDiarioDestino = $idCajaDiarioDestino;
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
    public function getCajaOrigen(): Text
    {
        return $this->cajaOrigen;
    }

    /**
     * @param Text $cajaOrigen
     */
    public function setCajaOrigen(Text $cajaOrigen): void
    {
        $this->cajaOrigen = $cajaOrigen;
    }

    /**
     * @return Text
     */
    public function getCajaDestino(): Text
    {
        return $this->cajaDestino;
    }

    /**
     * @param Text $cajaDestino
     */
    public function setCajaDestino(Text $cajaDestino): void
    {
        $this->cajaDestino = $cajaDestino;
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



}
