<?php

namespace Src\V2\ClienteMedioPago\Application;

use Google\Protobuf\Value;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\ClienteMedioPago\Domain\Contracts\ClienteMedioPagoRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var ClienteMedioPagoRepositoryContract
     */
    private ClienteMedioPagoRepositoryContract $repository;

    public function __construct( ClienteMedioPagoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        int $idMedioPago,
        bool $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idMedioPago = new NumericInteger($idMedioPago);
        $_idEstado = new ValueBoolean($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario que modifico no tiene el formato correcto');

        $this->repository->changeState(
            $_idCliente,
            $_idMedioPago,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
