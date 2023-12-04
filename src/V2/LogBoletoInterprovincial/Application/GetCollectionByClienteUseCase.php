<?php

declare(strict_types=1);

namespace Src\V2\LogBoletoInterprovincial\Application;

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

    public function __invoke(string $idCliente): LogBoletoInterprovincialList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->reLogBoletoInterprovincialitory->collectionByCliente($_idCliente);
    }
}
