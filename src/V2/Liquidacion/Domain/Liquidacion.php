<?php
declare(strict_types=1);

namespace Src\V2\Liquidacion\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class Liquidacion
{
    private Id $id;
    private Id $idCliente;
    private DateFormat $fechaDesde;
    private DateFormat $fechaHasta;
    private NumericInteger $idEstado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;


    private Text $estado;
    private Text $sede;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;
    private Id $idSede;
    private ValueBoolean $local;
    private NumericInteger $codigo;
    private array $idVehiculos;
    private Id $idPersonal;
    private Text $archivo;
    private Text $urlArchivo;
    private NumericFloat $monto;

    /**
     * @param Id $id
     * @param NumericInteger $codigo
     * @param Id $idCliente
     * @param Id $idSede
     * @param array $idVehiculos
     * @param Id $idPersonal
     * @param DateFormat $fechaDesde
     * @param DateFormat $fechaHasta
     * @param Text $archivo
     * @param Text $urlArchivo
     * @param NumericInteger $idEstado
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     * @param ValueBoolean $local
     * @param NumericFloat $monto
     */
    public function __construct(
        Id $id,
        NumericInteger $codigo,
        Id $idCliente,
        Id $idSede,
        array $idVehiculos,
        Id $idPersonal,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta,
        Text $archivo,
        Text $urlArchivo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico,
        ValueBoolean $local,
        NumericFloat $monto
    )
    {

        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;
        $this->idEstado = $idEstado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
        $this->idSede = $idSede;
        $this->local = $local;
        $this->codigo = $codigo;
        $this->idVehiculos = $idVehiculos;
        $this->idPersonal = $idPersonal;
        $this->archivo = $archivo;
        $this->urlArchivo = $urlArchivo;
        $this->monto = $monto;
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
     * @return DateFormat
     */
    public function getFechaDesde(): DateFormat
    {
        return $this->fechaDesde;
    }

    /**
     * @param DateFormat $fechaDesde
     */
    public function setFechaDesde(DateFormat $fechaDesde): void
    {
        $this->fechaDesde = $fechaDesde;
    }

    /**
     * @return DateFormat
     */
    public function getFechaHasta(): DateFormat
    {
        return $this->fechaHasta;
    }

    /**
     * @param DateFormat $fechaHasta
     */
    public function setFechaHasta(DateFormat $fechaHasta): void
    {
        $this->fechaHasta = $fechaHasta;
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
     * @return ValueBoolean
     */
    public function getLocal(): ValueBoolean
    {
        return $this->local;
    }

    /**
     * @param ValueBoolean $local
     */
    public function setLocal(ValueBoolean $local): void
    {
        $this->local = $local;
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
     * @return array
     */
    public function getIdVehiculos(): array
    {
        return $this->idVehiculos;
    }

    /**
     * @param array $idVehiculos
     */
    public function setIdVehiculos(array $idVehiculos): void
    {
        $this->idVehiculos = $idVehiculos;
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
     * @return Text
     */
    public function getArchivo(): Text
    {
        return $this->archivo;
    }

    /**
     * @param Text $archivo
     */
    public function setArchivo(Text $archivo): void
    {
        $this->archivo = $archivo;
    }

    /**
     * @return Text
     */
    public function getUrlArchivo(): Text
    {
        return $this->urlArchivo;
    }

    /**
     * @param Text $urlArchivo
     */
    public function setUrlArchivo(Text $urlArchivo): void
    {
        $this->urlArchivo = $urlArchivo;
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

}
