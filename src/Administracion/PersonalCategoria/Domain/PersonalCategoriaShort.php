<?php

declare(strict_types=1);

namespace Src\Administracion\PersonalCategoria\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class PersonalCategoriaShort
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
     * @var float|int|Numeric|string
     */
    private $codigo;
    /**
     * @var float|int|Numeric|string
     */
    private $idEstado;


    /**
     * PersonalCategoriaShort constructor.
     * @param Id $id
     * @param Text $nombre
     * @param Numeric $codigo
     * @param Numeric $idEstado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Numeric $codigo,
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
     * @return float|int|string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param float|int|string $codigo
     */
    public function setCodigo($codigo): void
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
