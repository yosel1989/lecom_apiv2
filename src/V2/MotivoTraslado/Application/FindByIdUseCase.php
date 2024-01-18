<?php

declare(strict_types=1);

namespace Src\V2\MotivoTraslado\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\MotivoTraslado\Domain\Contracts\MotivoTrasladoRepositoryContract;
use Src\V2\MotivoTraslado\Domain\MotivoTraslado;

final class FindByIdUseCase
{
    private MotivoTrasladoRepositoryContract $repository;

    public function __construct(MotivoTrasladoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idMotivoTraslado): MotivoTraslado
    {
        $_idMotivoTraslado = new Id($idMotivoTraslado,false, 'El id del MotivoTraslado no tiene el formato correcto');
        return $this->repository->find($_idMotivoTraslado);
    }
}
