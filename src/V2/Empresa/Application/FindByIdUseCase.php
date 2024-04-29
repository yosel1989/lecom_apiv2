<?php

declare(strict_types=1);

namespace Src\V2\Empresa\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Empresa\Domain\Contracts\EmpresaRepositoryContract;
use Src\V2\Empresa\Domain\Empresa;

final class FindByIdUseCase
{
    private EmpresaRepositoryContract $repository;

    public function __construct(EmpresaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idEmpresa): Empresa
    {
        $_idEmpresa = new Id($idEmpresa,false, 'El id de la empresa no tiene el formato correcto');
        return $this->repository->find($_idEmpresa);
    }
}
