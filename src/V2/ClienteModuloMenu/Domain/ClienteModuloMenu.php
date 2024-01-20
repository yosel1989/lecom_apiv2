<?php
declare(strict_types=1);

namespace Src\V2\ClienteModuloMenu\Domain;


use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;

final class ClienteModuloMenu
{
    private Id $idCliente;
    private NumericInteger $idModulo;
    private array $menu;

    /**
     * @param Id $idCliente
     * @param NumericInteger $idModulo
     * @param array $menu
     */
    public function __construct(
        Id $idCliente,
        NumericInteger $idModulo,
        array $menu
    )
    {
        $this->idCliente = $idCliente;
        $this->idModulo = $idModulo;
        $this->menu = $menu;
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


}
