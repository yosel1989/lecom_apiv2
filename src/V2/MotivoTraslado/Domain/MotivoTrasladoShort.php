<?php
declare(strict_types=1);

namespace Src\V2\MotivoTraslado\Domain;


use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class MotivoTrasladoShort
{
    private NumericInteger $id;
    private Text $nombre;

    /**
     * @param NumericInteger $id
     * @param Text $nombre
     */
    public function __construct(
        NumericInteger $id,
        Text $nombre,
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
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

}
