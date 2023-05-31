<?php


namespace Src\Administracion\Liquidacion\Application;

use Src\Administracion\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetCollectionByClientByDateRangeUseCase
{
    private $repository;

    public function __construct(LiquidacionRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $fechaDesde, string $fechaHasta): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        $dateStart = new DateOnlyFormat($fechaDesde,false,'La fecha inicio tiene un formato inválido');
        $dateEnd = new DateOnlyFormat($fechaHasta,false,'La fecha fin tiene un formato inválido');
        return $this->repository->collectionByClientByDateRange($id, $dateStart, $dateEnd);
    }

}
