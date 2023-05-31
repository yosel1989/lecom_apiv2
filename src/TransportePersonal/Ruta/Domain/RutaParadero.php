<?php

declare(strict_types=1);

namespace Src\TransportePersonal\Ruta\Domain;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class RutaParadero
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
     * @var Id
     */
    private $idTipoRuta;
    /**
     * @var Text
     */
    private $tipoRuta;


    /**
     * @param Id $idTipoRuta
     * @param Id $idParadero
     * @param Numeric $idTipo
     */
    public function __construct(
        Id $idTipoRuta,
        Id $idParadero,
        Numeric $idTipo
    )
    {
        $this->idParadero = $idParadero;
        $this->idTipo = $idTipo;
        $this->idTipoRuta = $idTipoRuta;
    }

    /**
     * @return Id
     */
    public function getIdTipoRuta(): Id
    {
        return $this->idTipoRuta;
    }

    /**
     * @param Id $idTipoRuta
     */
    public function setIdTipoRuta(Id $idTipoRuta): void
    {
        $this->idTipoRuta = $idTipoRuta;
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

    /**
     * @return Text
     */
    public function getTipoRuta(): Text
    {
        return $this->tipoRuta;
    }

    /**
     * @param Text $tipoRuta
     */
    public function setTipoRuta(Text $tipoRuta): void
    {
        $this->tipoRuta = $tipoRuta;
    }


}
