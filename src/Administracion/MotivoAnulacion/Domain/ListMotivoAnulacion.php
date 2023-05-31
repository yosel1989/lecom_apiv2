<?php

declare(strict_types=1);

namespace Src\Administracion\MotivoAnulacion\Domain;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class ListMotivoAnulacion
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
     * @var Id
     */
    private $idCliente;
    /**
     * @var float|int|Numeric|string
     */
    private $idEstado;

    /**
     * ListMotivoAnulacion constructor.
     * @param Id $id
     * @param Text $nombre
     * @param Id $idCliente
     * @param Numeric $idEstado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Id $idCliente,
        Numeric $idEstado
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
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
