<?php

declare(strict_types=1);

namespace Src\V2\Ruta\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Ruta\Domain\Contracts\RutaRepositoryContract;

final class GetListByClienteSedeTipoUseCase
{
    private RutaRepositoryContract $repository;

    public function __construct(RutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idSede, int $idTipo): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false, 'El id de la sede no tiene el formato correcto');
        $_idTipo = new NumericInteger($idTipo);
        return $this->repository->listByClienteSedeTipo($_idCliente, $_idSede, $_idTipo);
    }
}
