<?php
declare(strict_types=1);

namespace Src\V2\TipoPago\Domain;

use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class TipoPago
{
    private NumericInteger $id;
    private Text $nombre;
    private Text $valor;

    /**
     * @param NumericInteger $id
     * @param Text $nombre
     * @param Text $valor
     */
    public function __construct(
        NumericInteger $id,
        Text $nombre,
        Text $valor,
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->valor = $valor;
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
     * @return Text
     */
    public function getValor(): Text
    {
        return $this->valor;
    }

    /**
     * @param Text $valor
     */
    public function setValor(Text $valor): void
    {
        $this->valor = $valor;
    }
}
