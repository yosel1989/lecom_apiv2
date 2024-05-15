<?php
declare(strict_types=1);

namespace Src\V2\ClienteMedioPago\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class ClienteMedioPago
{
    private NumericInteger $idMedioPago;
    private Text $medioPago;
    private Text $usuarioRegistro;
    private DateTimeFormat $fechaRegistro;
    private ValueBoolean $activado;

    // secondary
    private NumericInteger $idTipo;
    private Text $tipo;

    /**
     * @param NumericInteger $idMedioPago
     * @param Text $medioPago
     * @param Text $usuarioRegistro
     * @param DateTimeFormat $fechaRegistro
     * @param ValueBoolean $activado
     */
    public function __construct(
        NumericInteger $idMedioPago,
        Text $medioPago,
        Text $usuarioRegistro,
        DateTimeFormat $fechaRegistro,
        ValueBoolean $activado
    )
    {

        $this->idMedioPago = $idMedioPago;
        $this->medioPago = $medioPago;
        $this->usuarioRegistro = $usuarioRegistro;
        $this->fechaRegistro = $fechaRegistro;
        $this->activado = $activado;
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
     * @return ValueBoolean
     */
    public function getActivado(): ValueBoolean
    {
        return $this->activado;
    }

    /**
     * @param ValueBoolean $activado
     */
    public function setActivado(ValueBoolean $activado): void
    {
        $this->activado = $activado;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipo(): NumericInteger
    {
        return $this->idTipo;
    }

    /**
     * @param NumericInteger $idTipo
     */
    public function setIdTipo(NumericInteger $idTipo): void
    {
        $this->idTipo = $idTipo;
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


}
