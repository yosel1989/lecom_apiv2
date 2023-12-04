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

}
