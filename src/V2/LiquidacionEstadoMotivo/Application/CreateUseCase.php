<?php

namespace Src\V2\LiquidacionEstadoMotivo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\LiquidacionEstadoMotivo\Domain\Contracts\LiquidacionEstadoMotivoRepositoryContract;

final class CreateUseCase
{
    /**
     * @var LiquidacionEstadoMotivoRepositoryContract
     */
    private LiquidacionEstadoMotivoRepositoryContract $repository;

    public function __construct( LiquidacionEstadoMotivoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idLiquidacion,
        int $idLiquidacionMotivo,
        string $idUsuarioRegistro
    ): void
    {

        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idLiquidacion = new Id($idLiquidacion,false, 'El id de la liquidación no tiene el formato correcto');
        $_motivo = new NumericInteger($idLiquidacionMotivo);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false, 'El id del cliente no tiene el formato correcto');


        $this->repository->create(
            $_idCliente,
            $_idLiquidacion,
            $_motivo,
            $_idUsuarioRegistro
        );

    }
}
