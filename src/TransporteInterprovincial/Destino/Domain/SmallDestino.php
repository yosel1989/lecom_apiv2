<?php
declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Domain;


use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\Numeric;
use Src\Core\Domain\ValueObjects\Text;


final class SmallDestino
{
    private Id $id;
    private Text $nombre;
    private Numeric $precioBase;
    private Numeric $idEstado;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param Numeric $precioBase
     * @param Numeric $idEstado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Numeric $precioBase,
        Numeric $idEstado
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->precioBase = $precioBase;
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
     * @return Numeric
     */
    public function getPrecioBase(): Numeric
    {
        return $this->precioBase;
    }

    /**
     * @param Numeric $precioBase
     */
    public function setPrecioBase(Numeric $precioBase): void
    {
        $this->precioBase = $precioBase;
    }

    /**
     * @return Numeric
     */
    public function getIdEstado(): Numeric
    {
        return $this->idEstado;
    }

    /**
     * @param Numeric $idEstado
     */
    public function setIdEstado(Numeric $idEstado): void
    {
        $this->idEstado = $idEstado;
    }


}
