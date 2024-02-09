<?php
declare(strict_types=1);

namespace Src\V2\LiquidacionEstadoMotivo\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class LiquidacionEstadoMotivo
{
    private Id $id;
    private Id $idCliente;
    private NumericInteger $idLiquidacionMotivo;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;

    // secondary
    private Text $usuarioRegistro;
    private Text $usuarioModifico;
    private Text $liquidacionMotivo;
    private Id $idLiquidacion;


    /**
     * @param Id $id
     * @param Id $idCliente
     * @param Id $idLiquidacion
     * @param NumericInteger $idLiquidacionMotivo
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Id $idCliente,
        Id $idLiquidacion,
        NumericInteger $idLiquidacionMotivo,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->idLiquidacionMotivo = $idLiquidacionMotivo;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
        $this->idLiquidacion = $idLiquidacion;
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
     * @return NumericInteger
     */
    public function getIdLiquidacionMotivo(): NumericInteger
    {
        return $this->idLiquidacionMotivo;
    }

    /**
     * @param NumericInteger $idLiquidacionMotivo
     */
    public function setIdLiquidacionMotivo(NumericInteger $idLiquidacionMotivo): void
    {
        $this->idLiquidacionMotivo = $idLiquidacionMotivo;
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
    public function getLiquidacionMotivo(): Text
    {
        return $this->liquidacionMotivo;
    }

    /**
     * @param Text $liquidacionMotivo
     */
    public function setLiquidacionMotivo(Text $liquidacionMotivo): void
    {
        $this->liquidacionMotivo = $liquidacionMotivo;
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
