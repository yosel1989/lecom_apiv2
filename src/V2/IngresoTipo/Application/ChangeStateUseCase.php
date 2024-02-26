<?php

namespace Src\V2\IngresoTipo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\IngresoTipo\Domain\Contracts\IngresoTipoRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var IngresoTipoRepositoryContract
     */
    private IngresoTipoRepositoryContract $repository;

    public function __construct( IngresoTipoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idIngresoTipo,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idIngresoTipo = new Id($idIngresoTipo,false,'El id del tipo no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idIngresoTipo,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
