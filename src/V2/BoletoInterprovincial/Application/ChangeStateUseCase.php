<?php

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class ChangeStateUseCase
{
    /**
     * @var BoletoInterprovincialRepositoryContract
     */
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct( BoletoInterprovincialRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idBoletoInterprovincial,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $_idBoletoInterprovincial = new Id($idBoletoInterprovincial,false,'El id del boleto no tiene el formato correcto');
        $_idUsuarioModifico = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);

        $this->repository->changeState(
            $_idBoletoInterprovincial,
            $_idEstado,
            $_idUsuarioModifico
        );

    }
}
