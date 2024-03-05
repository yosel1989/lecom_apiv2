<?php
declare(strict_types=1);

namespace Src\V2\CajaDiario\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class CajaDiarioReporte
{
    private Id $id;
    private Id $idCliente;
    private Id $idCaja;
    private Id $idSede;
    private Id $idUsuarioAperturo;
    private Id $idUsuarioCerro;
    private DateTimeFormat $fechaApertura;
    private DateTimeFormat $fechaCierre;
    private NumericFloat $saldoInicial;
    private NumericFloat $saldoFinal;
    private NumericInteger $idEstado;


    private Text $caja;
    private Text $sede;
    private Text $usuarioAperturo;
    private Text $usuarioCerro;
    private Text $estado;
    private NumericFloat $saldo;

    /**
     * @param Id $id
     * @param Id $idCliente
     * @param Id $idCaja
     * @param Id $idSede
     * @param Id $idUsuarioAperturo
     * @param Id $idUsuarioCerro
     * @param DateTimeFormat $fechaApertura
     * @param DateTimeFormat $fechaCierre
     * @param NumericFloat $saldoInicial
     * @param NumericFloat $saldoFinal
     * @param NumericInteger $idEstado
     */
    public function __construct(
        Id $id,
        Id $idCliente,
        Id $idCaja,
        Id $idSede,
        Id $idUsuarioAperturo,
        Id $idUsuarioCerro,
        DateTimeFormat $fechaApertura,
        DateTimeFormat $fechaCierre,
        NumericFloat $saldoInicial,
        NumericFloat $saldoFinal,
        NumericInteger $idEstado
    )
    {

        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->idCaja = $idCaja;
        $this->idSede = $idSede;
        $this->idUsuarioAperturo = $idUsuarioAperturo;
        $this->idUsuarioCerro = $idUsuarioCerro;
        $this->fechaApertura = $fechaApertura;
        $this->fechaCierre = $fechaCierre;
        $this->saldoInicial = $saldoInicial;
        $this->saldoFinal = $saldoFinal;
        $this->idEstado = $idEstado;
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
    public function getIdUsuarioAperturo(): Id
    {
        return $this->idUsuarioAperturo;
    }

    /**
     * @param Id $idUsuarioAperturo
     */
    public function setIdUsuarioAperturo(Id $idUsuarioAperturo): void
    {
        $this->idUsuarioAperturo = $idUsuarioAperturo;
    }

    /**
     * @return Id
     */
    public function getIdUsuarioCerro(): Id
    {
        return $this->idUsuarioCerro;
    }

    /**
     * @param Id $idUsuarioCerro
     */
    public function setIdUsuarioCerro(Id $idUsuarioCerro): void
    {
        $this->idUsuarioCerro = $idUsuarioCerro;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFechaApertura(): DateTimeFormat
    {
        return $this->fechaApertura;
    }

    /**
     * @param DateTimeFormat $fechaApertura
     */
    public function setFechaApertura(DateTimeFormat $fechaApertura): void
    {
        $this->fechaApertura = $fechaApertura;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFechaCierre(): DateTimeFormat
    {
        return $this->fechaCierre;
    }

    /**
     * @param DateTimeFormat $fechaCierre
     */
    public function setFechaCierre(DateTimeFormat $fechaCierre): void
    {
        $this->fechaCierre = $fechaCierre;
    }

    /**
     * @return NumericFloat
     */
    public function getSaldoInicial(): NumericFloat
    {
        return $this->saldoInicial;
    }

    /**
     * @param NumericFloat $saldoInicial
     */
    public function setSaldoInicial(NumericFloat $saldoInicial): void
    {
        $this->saldoInicial = $saldoInicial;
    }

    /**
     * @return NumericFloat
     */
    public function getSaldoFinal(): NumericFloat
    {
        return $this->saldoFinal;
    }

    /**
     * @param NumericFloat $saldoFinal
     */
    public function setSaldoFinal(NumericFloat $saldoFinal): void
    {
        $this->saldoFinal = $saldoFinal;
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
    public function getUsuarioAperturo(): Text
    {
        return $this->usuarioAperturo;
    }

    /**
     * @param Text $usuarioAperturo
     */
    public function setUsuarioAperturo(Text $usuarioAperturo): void
    {
        $this->usuarioAperturo = $usuarioAperturo;
    }

    /**
     * @return Text
     */
    public function getUsuarioCerro(): Text
    {
        return $this->usuarioCerro;
    }

    /**
     * @param Text $usuarioCerro
     */
    public function setUsuarioCerro(Text $usuarioCerro): void
    {
        $this->usuarioCerro = $usuarioCerro;
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
     * @return NumericFloat
     */
    public function getSaldo(): NumericFloat
    {
        return $this->saldo;
    }

    /**
     * @param NumericFloat $saldo
     */
    public function setSaldo(NumericFloat $saldo): void
    {
        $this->saldo = $saldo;
    }


}
