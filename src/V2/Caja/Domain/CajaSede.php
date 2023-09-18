<?php
declare(strict_types=1);

namespace Src\V2\Caja\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\Text;

final class CajaSede
{
    private Id $id;
    private Text $nombre;
    private Id $idSede;
    private Id $idCliente;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param Id $idCliente
     * @param Id $idSede
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Id $idCliente,
        Id $idSede
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->idSede = $idSede;
        $this->idCliente = $idCliente;
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
    public function getIdSede(): Id
    {
        return $this->idSede;
    }

    /**
     * @param Id $idSede
     */
    public function setIdSede(Id $idSede): void
    {
        $this->idSede = $idSede;
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


}
