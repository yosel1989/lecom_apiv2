<?php

namespace Src\V2\Cliente\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Cliente\Domain\Contracts\ClienteRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var ClienteRepositoryContract
     */
    private ClienteRepositoryContract $repository;

    public function __construct( ClienteRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idCliente,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
