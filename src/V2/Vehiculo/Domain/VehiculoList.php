<?php
declare(strict_types=1);

namespace Src\V2\Vehiculo\Domain;


use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\Text;

final class VehiculoList
{
    private Id $id;
    private Text $placa;
    private Text $unidad;

    /**
     * @param Id $id
     * @param Text $placa
     * @param Text $unidad
     */
    public function __construct(
        Id $id,
        Text $placa,
        Text $unidad
    )
    {

        $this->id = $id;
        $this->placa = $placa;
        $this->unidad = $unidad;
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
    public function getPlaca(): Text
    {
        return $this->placa;
    }

    /**
     * @param Text $placa
     */
    public function setPlaca(Text $placa): void
    {
        $this->placa = $placa;
    }

    /**
     * @return Text
     */
    public function getUnidad(): Text
    {
        return $this->unidad;
    }

    /**
     * @param Text $unidad
     */
    public function setUnidad(Text $unidad): void
    {
        $this->unidad = $unidad;
    }


}
