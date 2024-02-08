<?php

declare(strict_types=1);

namespace Src\V2\Liquidacion\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
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

    public function __invoke(string $idCliente, string $fechaDesde, string $fechaHasta): LiquidacionList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_fechaDesde = new DateFormat($fechaDesde,false, 'La fecha inicial no tiene el formato correcto');
        $_fechaHasta = new DateFormat($fechaHasta,false, 'La fecha final no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente, $_fechaDesde, $_fechaHasta);
    }
}
