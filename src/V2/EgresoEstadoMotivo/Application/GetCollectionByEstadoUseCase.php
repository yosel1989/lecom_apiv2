<?php

declare(strict_types=1);

namespace Src\V2\EgresoEstadoMotivo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\EgresoEstadoMotivo\Domain\Contracts\EgresoEstadoMotivoRepositoryContract;
use Src\V2\EgresoEstadoMotivo\Domain\EgresoEstadoMotivoList;

final class GetCollectionByEstadoUseCase
{
    private EgresoEstadoMotivoRepositoryContract $repository;

    public function __construct(EgresoEstadoMotivoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idEgreso): EgresoEstadoMotivoList
    {
        $_idEgreso = new Id($idEgreso, false, 'El id del ingreso no tiene el formato correcto');
        return $this->repository->collectionByEgreso($_idEgreso);
    }
}
