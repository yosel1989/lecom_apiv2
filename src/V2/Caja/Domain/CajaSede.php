<?php
declare(strict_types=1);

namespace Src\V2\Caja\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class CajaSede
{
    private Id $id;
    private Text $nombre;
    private Id $idSede;
    private Id $idCliente;


    private ValueBoolean $aperturado;
    private Id $idCajaDiario;
    private NumericInteger $idEstado;
    private Text $estado;
    private DateTimeFormat $fechaApertura;
    private NumericFloat $saldo;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param Id $idCliente
     * @param Id $idSede
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Id $idCliente,
        Id $idSede
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->idSede = $idSede;
        $this->idCliente = $idCliente;
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
     * @return ValueBoolean
     */
    public function getAperturado(): ValueBoolean
    {
        return $this->aperturado;
    }

    /**
     * @param ValueBoolean $aperturado
     */
    public function setAperturado(ValueBoolean $aperturado): void
    {
        $this->aperturado = $aperturado;
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
