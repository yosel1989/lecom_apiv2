<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class TraslateByIdUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idVehiculo, string $idBoletoInterprovincial, string $idUsuario, int $idMotivo): void
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idVehiculo = new Id($idVehiculo,false, 'El id del vehiculo no tiene el formato correcto');
        $_idBoletoInterprovincial = new Id($idBoletoInterprovincial,false, 'El id del boleto no tiene el formato correcto');
        $_idUsuario = new Id($idUsuario,false, 'El id del usuario no tiene el formato correcto');
        $_idMotivo = new NumericInteger($idMotivo);
        $this->repository->traslateById($_idCliente, $_idVehiculo, $_idBoletoInterprovincial, $_idUsuario, $_idMotivo);
    }
}
