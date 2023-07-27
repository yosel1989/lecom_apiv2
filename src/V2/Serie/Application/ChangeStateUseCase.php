<?php

namespace Src\V2\Serie\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Serie\Domain\Contracts\SerieRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var SerieRepositoryContract
     */
    private SerieRepositoryContract $repository;

    public function __construct( SerieRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idSerie,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idSerie = new Id($idSerie,false,'El id del Serie no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idSerie,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
