<?php

declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;
use Src\V2\CronogramaSalida\Domain\CronogramaSalida;

final class FindByIdUseCase
{
    private CronogramaSalidaRepositoryContract $repository;

    public function __construct(CronogramaSalidaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCronogramaSalida): CronogramaSalida
    {
        $_idCronogramaSalida = new Id($idCronogramaSalida,false, 'El id del CronogramaSalida no tiene el formato correcto');
        return $this->repository->find($_idCronogramaSalida);
    }
}
