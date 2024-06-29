<?php
declare(strict_types=1);

namespace Src\V2\RutaSede\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class RutaSede
{

    private Id $id;
    private Id $idCliente;
    private Id $idRuta;
    private Id $idSede;

    //
    private Text $sede;
    private ValueBoolean $selected;

    /**
     * @param Id $id
     * @param Id $idCliente
     * @param Id $idRuta
     * @param Id $idSede
     */
    public function __construct(
        Id $id,
        Id $idCliente,
        Id $idRuta,
        Id $idSede
    )
    {

        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->idRuta = $idRuta;
        $this->idSede = $idSede;
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
     * @return Id
     */
    public function getIdRuta(): Id
    {
        return $this->idRuta;
    }

    /**
     * @param Id $idRuta
     */
    public function setIdRuta(Id $idRuta): void
    {
        $this->idRuta = $idRuta;
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
     * @return Text
     */
    public function getSede(): Text
    {
        return $this->sede;
    }

    /**
     * @param Text $sede
     */
    public function setSede(Text $sede): void
    {
        $this->sede = $sede;
    }

    /**
     * @return ValueBoolean
     */
    public function getSelected(): ValueBoolean
    {
        return $this->selected;
    }

    /**
     * @param ValueBoolean $selected
     */
    public function setSelected(ValueBoolean $selected): void
    {
        $this->selected = $selected;
    }

}
