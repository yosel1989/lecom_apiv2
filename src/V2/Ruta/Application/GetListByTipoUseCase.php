<?php

declare(strict_types=1);

namespace Src\V2\Ruta\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Ruta\Domain\Contracts\RutaRepositoryContract;

final class GetListByTipoUseCase
{
    private RutaRepositoryContract $repository;

    public function __construct(RutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $idTipoRuta, string $idCliente): array
    {
        $_idTipoRuta = new NumericInteger($idTipoRuta);
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByTipo($_idTipoRuta,$_idCliente);
    }
}
