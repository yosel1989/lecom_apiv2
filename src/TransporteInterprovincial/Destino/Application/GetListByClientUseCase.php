<?php

declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Application;

use Src\TransporteInterprovincial\Destino\Domain\Contracts\DestinoRepositoryContract;
use Src\Core\Domain\ValueObjects\Id;

final class GetListByClientUseCase
{
    /**
     * @var DestinoRepositoryContract
     */
    private DestinoRepositoryContract $repository;

    public function __construct(DestinoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente);
        return $this->repository->listByClient($_idCliente);
    }
}
