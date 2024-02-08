<?php

declare(strict_types=1);

namespace Src\V2\Liquidacion\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;
use Src\V2\Liquidacion\Domain\LiquidacionList;

final class GetCollectionByClienteUseCase
{
    private LiquidacionRepositoryContract $repository;

    public function __construct(LiquidacionRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): LiquidacionList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
