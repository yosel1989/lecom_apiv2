<?php

declare(strict_types=1);

namespace Src\V2\Paradero\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Paradero\Domain\Contracts\ParaderoRepositoryContract;

final class GetListByClienteByTipoRutaUseCase
{
    private ParaderoRepositoryContract $repository;

    public function __construct(ParaderoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, int $idTipoRuta): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idTipoRuta = new NumericInteger($idTipoRuta);
        return $this->repository->listByClienteByTipoRuta($_idCliente, $_idTipoRuta);
    }
}
