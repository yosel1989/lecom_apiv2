<?php

declare(strict_types=1);

namespace Src\TransportePersonal\Troncal\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class TroncalParadero
{
    /**
     * @var Id
     */
    private $idParadero;
    /**
     * @var float|int|Numeric|string
     */
    private $idTipo;
    /**
     * @var Text
     */
    private $paradero;


    /**
     * @param Id $idParadero
     * @param Numeric $idTipo
     */
    public function __construct(
        Id $idParadero,
        Numeric $idTipo
    )
    {
        $this->idParadero = $idParadero;
        $this->idTipo = $idTipo;
    }

    /**
     * @return Id
     */
    public function getIdParadero(): Id
    {
        return $this->idParadero;
    }

    /**
     * @param Id $idParadero
     */
    public function setIdParadero(Id $idParadero): void
    {
        $this->idParadero = $idParadero;
    }

    /**
     * @return float|int|Numeric|string
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
     * @param float|int|Numeric|string $idTipo
     */
    public function setIdTipo($idTipo): void
    {
        $this->idTipo = $idTipo;
    }

    /**
     * @return Text
     */
    public function getParadero(): Text
    {
        return $this->paradero;
    }

    /**
     * @param Text $paradero
     */
    public function setParadero(Text $paradero): void
    {
        $this->paradero = $paradero;
    }


}
