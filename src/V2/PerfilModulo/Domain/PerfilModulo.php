<?php
declare(strict_types=1);

namespace Src\V2\PerfilModulo\Domain;


use Src\Core\Domain\ValueObjects\Id;

final class PerfilModulo
{
    private Id $idPerfil;
    private array $modulos;

    /**
     * @param Id $idPerfil
     * @param array $modulos
     */
    public function __construct(
        Id $idPerfil,
        array $modulos
    )
    {

        $this->idPerfil = $idPerfil;
        $this->modulos = $modulos;
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
    public function getModulos(): array
    {
        return $this->modulos;
    }

    /**
     * @param array $modulos
     */
    public function setModulos(array $modulos): void
    {
        $this->modulos = $modulos;
    }

}
