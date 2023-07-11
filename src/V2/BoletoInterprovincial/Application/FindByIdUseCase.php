<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincial;

final class FindByIdUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idBoletoInterprovincial): BoletoInterprovincial
    {
        $_idBoletoInterprovincial = new Id($idBoletoInterprovincial,false, 'El id del boleto no tiene el formato correcto');
        return $this->repository->find($_idBoletoInterprovincial);
    }
}
