<?php

declare(strict_types=1);

namespace Src\V2\CajaTraslado\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CajaTraslado\Domain\Contracts\CajaTrasladoRepositoryContract;
use Src\V2\CajaTraslado\Domain\CajaTrasladoList;

final class GetReporteByUsuarioUseCase
{
    private CajaTrasladoRepositoryContract $repository;

    public function __construct(CajaTrasladoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idUsuario, string $fecha): CajaTrasladoList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idUsuario = new Id($idUsuario,false, 'El id del usuario no tiene el formato correcto');
        $_fecha = new DateFormat($fecha,false, 'El fecha no tiene el formato correcto');
        return $this->repository->reporteByUsuario($_idCliente, $_idUsuario, $_fecha);
    }
}
