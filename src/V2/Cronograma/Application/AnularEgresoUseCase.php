<?php

namespace Src\V2\Cronograma\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Cronograma\Domain\Contracts\CronogramaRepositoryContract;

final class AnularCronogramaUseCase
{
    /**
     * @var CronogramaRepositoryContract
     */
    private CronogramaRepositoryContract $repository;

    public function __construct( CronogramaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCronograma,
        string $idUsuarioModifico
    ): void
    {
        $_idCronograma = new Id($idCronograma,false,'El id del Cronograma no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');

        $this->repository->anular(
            $_idCronograma,
            $_idUsuarioModifico
        );

    }
}
