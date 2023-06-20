<?php

declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Application;

use Src\TransporteInterprovincial\Destino\Domain\Contracts\DestinoRepositoryContract;
use Src\Core\Domain\ValueObjects\Id;

final class GetCollectionByClientUseCase
{
    /**
     * @var DestinoRepositoryContract
     */
    private $repository;

    public function __construct(DestinoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $_idCliente = new Id($idCliente);
        return $this->repository->collectionByClient($_idCliente);
    }
}
