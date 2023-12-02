<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class GetReportByClienteUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $fechaDesde, string $fechaHasta, ?string $idRuta, string $idUsuario): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_fechaDesde = new DateFormat($fechaDesde,false, 'El fecha inicio no tiene el formato correcto');
        $_fechaHasta= new DateFormat($fechaHasta,false, 'El fecha final no tiene el formato correcto');
        $_idRuta= new Id($idRuta,true, 'El id de la ruta no tiene el formato correcto');
        $_idUsuario= new Id($idUsuario,true, 'El id del usuario no tiene el formato correcto');
        return $this->repository->reportByCliente($_idCliente, $_fechaDesde, $_fechaHasta, $_idRuta, $_idUsuario);
    }
}
