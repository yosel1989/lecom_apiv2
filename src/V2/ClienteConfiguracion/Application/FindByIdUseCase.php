<?php

declare(strict_types=1);

namespace Src\V2\ClienteConfiguracion\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\ClienteConfiguracion\Domain\Contracts\ClienteConfiguracionRepositoryContract;
use Src\V2\ClienteConfiguracion\Domain\ClienteConfiguracion;

final class FindByIdUseCase
{
    private ClienteConfiguracionRepositoryContract $repository;

    public function __construct(ClienteConfiguracionRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): ClienteConfiguracion
    {
        $_idCliente = new Id($idCliente,false, 'El id del Cliente no tiene el formato correcto');
        return $this->repository->find($_idCliente);
    }
}
