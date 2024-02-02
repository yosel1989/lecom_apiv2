<?php
declare(strict_types=1);

namespace Src\V2\TipoPersonal\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class TipoPersonalShort
{
    private Id $id;
    private Text $nombre;
    private Id $idCliente;
    private NumericInteger $idEstado;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param Id $idCliente
     * @param NumericInteger $idEstado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Id $idCliente,
        NumericInteger $idEstado
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
     * @return NumericInteger
     */
    public function getIdEstado(): NumericInteger
    {
        return $this->idEstado;
    }

    /**
     * @param NumericInteger $idEstado
     */
    public function setIdEstado(NumericInteger $idEstado): void
    {
        $this->idEstado = $idEstado;
    }


}
