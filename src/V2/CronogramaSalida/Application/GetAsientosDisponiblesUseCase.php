<?php

declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;

final class GetAsientosDisponiblesUseCase
{
    private CronogramaSalidaRepositoryContract $repository;

    public function __construct(CronogramaSalidaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idCronogramaSalida): NumericInteger
    {
        $_idCliente = new Id($idCliente, false, 'El id del cliente no tiene el formato correcto');
        $_idCronogramaSalida = new Id($idCronogramaSalida, false, 'El id de la salida no tiene el formato correcto');

        return $this->repository->asientosDisponibles($_idCliente, $_idCronogramaSalida);
    }
}
