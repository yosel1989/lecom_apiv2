<?php
declare(strict_types=1);

namespace Src\V2\TipoDocumento\Domain;

use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class TipoDocumento
{
    private NumericInteger $id;
    private Text $nombre;
    private NumericInteger $numeroDigitos;

    /**
     * @param NumericInteger $id
     * @param Text $nombre
     * @param NumericInteger $numeroDigitos
     */
    public function __construct(
        NumericInteger $id,
        Text $nombre,
        NumericInteger $numeroDigitos
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->numeroDigitos = $numeroDigitos;
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
    public function getNumeroDigitos(): NumericInteger
    {
        return $this->numeroDigitos;
    }

    /**
     * @param NumericInteger $numeroDigitos
     */
    public function setNumeroDigitos(NumericInteger $numeroDigitos): void
    {
        $this->numeroDigitos = $numeroDigitos;
    }



}
