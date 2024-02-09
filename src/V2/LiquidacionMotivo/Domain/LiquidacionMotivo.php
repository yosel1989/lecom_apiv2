<?php
declare(strict_types=1);

namespace Src\V2\LiquidacionMotivo\Domain;

use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class LiquidacionMotivo
{
    private NumericInteger $id;
    private Text $nombre;
    private NumericInteger $idEstado;

    /**
     * @param NumericInteger $id
     * @param Text $nombre
     * @param NumericInteger $idEstado
     */
    public function __construct(
        NumericInteger $id,
        Text $nombre,
        NumericInteger $idEstado,

    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->idEstado = $idEstado;
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

}
