<?php

namespace Src\V2\Destino\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Destino\Domain\Contracts\DestinoRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var DestinoRepositoryContract
     */
    private DestinoRepositoryContract $repository;

    public function __construct( DestinoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idDestino,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idDestino = new Id($idDestino,false,'El id del destino no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idDestino,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
