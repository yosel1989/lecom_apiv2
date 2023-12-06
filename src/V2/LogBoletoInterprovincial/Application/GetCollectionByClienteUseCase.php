<?php

declare(strict_types=1);

namespace Src\V2\LogBoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\LogBoletoInterprovincial\Domain\Contracts\LogBoletoInterprovincialRepositoryContract;
use Src\V2\LogBoletoInterprovincial\Domain\LogBoletoInterprovincialList;

final class GetCollectionByClienteUseCase
{
    private LogBoletoInterprovincialRepositoryContract $reLogBoletoInterprovincialitory;

    public function __construct(LogBoletoInterprovincialRepositoryContract $reLogBoletoInterprovincialitory)
    {
        $this->reLogBoletoInterprovincialitory = $reLogBoletoInterprovincialitory;
    }

    public function __invoke(string $idCliente, string $fecha): LogBoletoInterprovincialList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_fecha = new DateFormat($fecha,false, 'El formato de la fecha no es correcta');
        return $this->reLogBoletoInterprovincialitory->collectionByCliente($_idCliente, $_fecha);
    }
}
