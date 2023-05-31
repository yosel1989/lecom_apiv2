<?php


namespace Src\TransportePersonal\Reporte\Application;


use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\TransportePersonal\Reporte\Domain\Contracts\ReporteRepositoryContract;

final class GetReportByClientUseCase
{
    private $repository;

    public function __construct(ReporteRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $fechaDesde,
        string $fechaHasta
    ): array
    {
        $Id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        $FechaDesde = new DateOnlyFormat($fechaDesde,false,'El formato de fecha inicial no tiene el formato válido');
        $FechaHasta = new DateOnlyFormat($fechaHasta,false,'El formato de fecha final no tiene el formato válido');
        return $this->repository->reportByClient($Id, $FechaDesde, $FechaHasta);
    }

}
