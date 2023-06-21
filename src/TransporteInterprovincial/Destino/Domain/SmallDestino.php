<?php
declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Domain;


use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;


final class SmallDestino
{
    private Id $id;
    private Text $nombre;
    private NumericFloat $precioBase;
    private NumericInteger $idEstado;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param NumericFloat $precioBase
     * @param NumericInteger $idEstado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        NumericFloat $precioBase,
        NumericInteger $idEstado
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
     * @return NumericFloat
     */
    public function getPrecioBase(): NumericFloat
    {
        return $this->precioBase;
    }

    /**
     * @param NumericFloat $precioBase
     */
    public function setPrecioBase(NumericFloat $precioBase): void
    {
        $this->precioBase = $precioBase;
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
