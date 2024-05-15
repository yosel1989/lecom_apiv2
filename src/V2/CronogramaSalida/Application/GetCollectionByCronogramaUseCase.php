<?php

declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaList;

final class GetCollectionByCronogramaUseCase
{
    private CronogramaSalidaRepositoryContract $repository;

    public function __construct(CronogramaSalidaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCronograma): CronogramaSalidaList
    {
        $_idCronograma = new Id($idCronograma,false, 'El id del cronograma no tiene el formato correcto');
        return $this->repository->collectionByCronograma($_idCronograma);
    }
}
