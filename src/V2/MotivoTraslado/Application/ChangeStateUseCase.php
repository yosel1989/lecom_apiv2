<?php

namespace Src\V2\MotivoTraslado\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\MotivoTraslado\Domain\Contracts\MotivoTrasladoRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var MotivoTrasladoRepositoryContract
     */
    private MotivoTrasladoRepositoryContract $repository;

    public function __construct( MotivoTrasladoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idMotivoTraslado,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idMotivoTraslado = new Id($idMotivoTraslado,false,'El id del MotivoTraslado no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idMotivoTraslado,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
