<?php
declare(strict_types=1);

namespace Src\V2\PerfilModuloMenu\Domain;


use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;

final class PerfilModuloMenu
{
    private Id $idPerfil;
    private array $menu;
    private NumericInteger $idModulo;

    /**
     * @param Id $idPerfil
     * @param NumericInteger $idModulo
     * @param array $menu
     */
    public function __construct(
        Id $idPerfil,
        NumericInteger $idModulo,
        array $menu
    )
    {

        $this->idPerfil = $idPerfil;
        $this->menu = $menu;
        $this->idModulo = $idModulo;
    }

    /**
     * @return Id
     */
    public function getIdPerfil(): Id
    {
        return $this->idPerfil;
    }

    /**
     * @param Id $idPerfil
     */
    public function setIdPerfil(Id $idPerfil): void
    {
        $this->idPerfil = $idPerfil;
    }

    /**
     * @return array
     */
    public function getMenu(): array
    {
        return $this->menu;
    }

    /**
     * @param array $menu
     */
    public function setMenu(array $menu): void
    {
        $this->menu = $menu;
    }

    /**
     * @return NumericInteger
     */
    public function getIdModulo(): NumericInteger
    {
        return $this->idModulo;
    }

    /**
     * @param NumericInteger $idModulo
     */
    public function setIdModulo(NumericInteger $idModulo): void
    {
        $this->idModulo = $idModulo;
    }



}
