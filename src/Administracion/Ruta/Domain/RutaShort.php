<?php

declare(strict_types=1);

namespace Src\Administracion\Ruta\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class RutaShort
{
    /**
     * @var Id
     */
    private $id;
    /**
     * @var Text
     */
    private $nombre;
    /**
     * @var Text
     */
    private $codigo;
    /**
     * @var float|int|Numeric|string
     */
    private $idEstado;

    /**
     * RutaShort constructor.
     * @param Id $id
     * @param Text $nombre
     * @param Text $codigo
     * @param Numeric $idEstado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Text $codigo,
        Numeric $idEstado
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->idEstado = $idEstado;
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
     * @return Text
     */
    public function getCodigo(): Text
    {
        return $this->codigo;
    }

    /**
     * @param Text $codigo
     */
    public function setCodigo(Text $codigo): void
    {
        $this->codigo = $codigo;
    }

    /**
     * @return float|int|string
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * @param float|int|string $idEstado
     */
    public function setIdEstado($idEstado): void
    {
        $this->idEstado = $idEstado;
    }


}
