<?php

declare(strict_types=1);

namespace Src\V2\Serie\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Serie\Domain\Contracts\SerieRepositoryContract;

final class GetListByClienteUseCase
{
    private SerieRepositoryContract $repository;

    public function __construct(SerieRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByCliente($_idCliente);
    }
}
