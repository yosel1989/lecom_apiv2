<?php

declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaList;

final class GetCollectionByRutaUseCase
{
    private CronogramaSalidaRepositoryContract $repository;

    public function __construct(CronogramaSalidaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idRuta): CronogramaSalidaList
    {
        $_idRuta = new Id($idRuta,false, 'El id de la ruta no tiene el formato correcto');
        return $this->repository->collectionByRuta($_idRuta);
    }
}
