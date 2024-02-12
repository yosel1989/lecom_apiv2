<?php

namespace Src\V2\Egreso\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\V2\Egreso\Domain\Contracts\EgresoRepositoryContract;
use Src\V2\Egreso\Domain\Egreso;

final class CreateUseCase
{
    /**
     * @var EgresoRepositoryContract
     */
    private EgresoRepositoryContract $repository;

    public function __construct( EgresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $idCliente,
        string $idSede,
        ?string $idVehiculo,
        ?string $idPersonal,
        float $total,
        string $idCaja,
        string $idCajaDiario,
        string $idUsuarioRegistro
    ): Egreso
    {

        $_id = new Id($id,false, 'El id del egreso no tiene el formato correcto');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false,'El id de la sede no tiene el formato correcto');
        $_idVehiculo = new Id($idVehiculo,true,'El id del vehiculo no tiene el formato correcto');
        $_idPersonal = new Id($idPersonal,true,'El id del personal no tiene el formato correcto');
        $_total = new NumericFloat($total);
        $_idCaja = new Id($idCaja,false,'El id de la caja no tiene el formato correcto');
        $_idCajaDiario = new Id($idCajaDiario,false,'El id de la caja diario no tiene el formato correcto');
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        return $this->repository->create(
            $_id,
            $_idCliente,
            $_idSede,
            $_idVehiculo,
            $_idPersonal,
            $_total,
            $_idCaja,
            $_idCajaDiario,
            $_idUsuarioRegistro
        );

    }
}
