<?php

declare(strict_types=1);

namespace Src\V2\ComprobanteSerie\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\ComprobanteSerie\Domain\ComprobanteSerieShort;
use Src\V2\ComprobanteSerie\Domain\Contracts\ComprobanteSerieRepositoryContract;

final class FindByEmpresaTipoComprobanteSedeUseCase
{
    private ComprobanteSerieRepositoryContract $repository;

    public function __construct(ComprobanteSerieRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idEmpresa,
        string $idSede,
        int $idTipoComprobante,
    ): ComprobanteSerieShort
    {
        $_idEmpresa = new Id($idEmpresa,false, 'El id de la empresa no tiene el formato correcto');
        $_idSede = new Id($idSede,false, 'El id de la sede no tiene el formato correcto');
        $_idTipoComprobante = new NumericInteger($idTipoComprobante);
        return $this->repository->findByEmpresaTipoComprobanteSede($_idEmpresa, $_idSede, $_idTipoComprobante);
    }
}
