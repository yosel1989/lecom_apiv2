<?php

declare(strict_types=1);

namespace Src\Administracion\Personal\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class PersonalShort
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
    private $apellido;
    /**
     * @var Id
     */
    private $idCliente;
    /**
     * @var float|int|Numeric|string
     */
    private $idEstado;

    /**
     * PersonalShort constructor.
     * @param Id $id
     * @param Text $nombre
     * @param Text $apellido
     * @param Id $idCliente
     * @param Numeric $idEstado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Text $apellido,
        Id $idCliente,
        Numeric $idEstado
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->idCliente = $idCliente;
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
    public function getApellido(): Text
    {
        return $this->apellido;
    }

    /**
     * @param Text $apellido
     */
    public function setApellido(Text $apellido): void
    {
        $this->apellido = $apellido;
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
