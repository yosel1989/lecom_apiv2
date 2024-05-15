<?php

namespace Src\V2\CajaTraslado\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\CajaTraslado\Domain\Contracts\CajaTrasladoRepositoryContract;
use Src\V2\CajaTraslado\Domain\CajaTraslado;

final class CreateUseCase
{
    /**
     * @var CajaTrasladoRepositoryContract
     */
    private CajaTrasladoRepositoryContract $repository;

    public function __construct( CajaTrasladoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $idCliente,
        string $idSede,
        int $idTipoComprobante,
        string $idPersonal,
        string $idCajaOrigen,
        string $idCajaDestino,
        float $monto,
        string $idUsuarioRegistro
    ): CajaTraslado
    {

        $_id = new Id($id,false, 'El id del CajaTraslado no tiene el formato correcto');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false,'El id de la sede no tiene el formato correcto');
        $_idTipoComprobante = new NumericInteger($idTipoComprobante);
        $_idPersonal = new Id($idPersonal,false,'El id del personal no tiene el formato correcto');
        $_idCajaOrigen = new Id($idCajaOrigen,false,'El id de la caja origen no tiene el formato correcto');
        $_idCajaDestino = new Id($idCajaDestino,false,'El id de la caja destino no tiene el formato correcto');
        $_monto = new NumericFloat($monto);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        return $this->repository->create(
            $_id,
            $_idCliente,
            $_idSede,
            $_idTipoComprobante,
            $_idPersonal,
            $_idCajaOrigen,
            $_idCajaDestino,
            $_monto,
            $_idUsuarioRegistro
        );

    }
}
