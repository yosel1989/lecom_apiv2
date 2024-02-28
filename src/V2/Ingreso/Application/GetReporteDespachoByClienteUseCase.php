<?php

declare(strict_types=1);

namespace Src\V2\Ingreso\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Ingreso\Domain\Contracts\IngresoRepositoryContract;
use Src\V2\Ingreso\Domain\IngresoList;

final class GetReporteDespachoByClienteUseCase
{
    private IngresoRepositoryContract $repository;

    public function __construct(IngresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idUsuario, string $fecha): IngresoList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idUsuario = new Id($idUsuario,false, 'El id del usuario no tiene el formato correcto');
        $_fecha = new DateFormat($fecha,false, 'El fecha no tiene el formato correcto');
        return $this->repository->reporteDespachoByCliente($_idCliente, $_idUsuario, $_fecha);
    }
}
