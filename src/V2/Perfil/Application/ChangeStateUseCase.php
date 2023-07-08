<?php

namespace Src\V2\Perfil\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Perfil\Domain\Contracts\PerfilRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var PerfilRepositoryContract
     */
    private PerfilRepositoryContract $repository;

    public function __construct( PerfilRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idPerfil,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idPerfil = new Id($idPerfil,false,'El id del perfil no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idPerfil,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
