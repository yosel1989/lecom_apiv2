<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class GetPasajerosByCronogramaSalidaUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idCronogramaSalida): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idCronogramaSalida = new Id($idCronogramaSalida,false, 'El id de la salida no tiene el formato correcto');
        return $this->repository->pasajerosByCronogramaSalida($_idCliente, $_idCronogramaSalida);
    }
}
