<?php
declare(strict_types=1);

namespace Src\V2\LogBoletoInterprovincial\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class LogBoletoInterprovincial
{
    private NumericInteger $id;
    private Id $idCliente;
    private Text $motivo;
    private Text $descripcion;
    private DateTimeFormat $fecha;

    /**
     * @param NumericInteger $id
     * @param Id $idCliente
     * @param Text $motivo
     * @param Text $descripcion
     * @param DateTimeFormat $fecha
     */
    public function __construct(
        NumericInteger $id,
        Id $idCliente,
        Text $motivo,
        Text $descripcion,
        DateTimeFormat $fecha
    )
    {
        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->motivo = $motivo;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
    }

    /**
     * @return NumericInteger
     */
    public function getId(): NumericInteger
    {
        return $this->id;
    }

    /**
     * @param NumericInteger $id
     */
    public function setId(NumericInteger $id): void
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
     * @return Text
     */
    public function getMotivo(): Text
    {
        return $this->motivo;
    }

    /**
     * @param Text $motivo
     */
    public function setMotivo(Text $motivo): void
    {
        $this->motivo = $motivo;
    }

    /**
     * @return Text
     */
    public function getDescripcion(): Text
    {
        return $this->descripcion;
    }

    /**
     * @param Text $descripcion
     */
    public function setDescripcion(Text $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFecha(): DateTimeFormat
    {
        return $this->fecha;
    }

    /**
     * @param DateTimeFormat $fecha
     */
    public function setFecha(DateTimeFormat $fecha): void
    {
        $this->fecha = $fecha;
    }



}
