<?php

declare(strict_types=1);

namespace Src\V2\CajaTraslado\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CajaTraslado\Domain\Contracts\CajaTrasladoRepositoryContract;
use Src\V2\CajaTraslado\Domain\CajaTraslado;

final class FindPdfByIdUseCase
{
    private CajaTrasladoRepositoryContract $repository;

    public function __construct(CajaTrasladoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCajaTraslado): CajaTraslado
    {
        $_idCajaTraslado = new Id($idCajaTraslado,false, 'El id del CajaTraslado no tiene el formato correcto');
        return $this->repository->findPdf($_idCajaTraslado);
    }
}
