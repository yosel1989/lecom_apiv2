<?php

declare(strict_types=1);

namespace Src\TransportePersonal\Paradero\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Text;

final class ListParadero
{
    /**
     * @var Id
     */
    private $id;
    /**
     * @var Text
     */
    private $nombre;

    public function __construct(
        Id $id,
        Text $nombre
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
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


}
