<?php

declare(strict_types=1);

namespace Src\V2\Perfil\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Perfil\Domain\Contracts\PerfilRepositoryContract;

final class GetListByClienteByNivelUseCase
{
    private PerfilRepositoryContract $repository;

    public function __construct(PerfilRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, int $idNivelUsuario): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idNivelUsuario = new NumericInteger($idNivelUsuario);
        return $this->repository->listByClienteByNivel($_idCliente, $_idNivelUsuario);
    }
}
