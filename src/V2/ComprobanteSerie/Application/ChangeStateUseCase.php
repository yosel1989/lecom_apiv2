<?php

namespace Src\V2\ComprobanteSerie\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\ComprobanteSerie\Domain\Contracts\ComprobanteSerieRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var ComprobanteSerieRepositoryContract
     */
    private ComprobanteSerieRepositoryContract $repository;

    public function __construct( ComprobanteSerieRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_id = new Id($id,false,'El id no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_id,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
