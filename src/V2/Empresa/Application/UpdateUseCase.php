<?php

namespace Src\V2\Empresa\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Empresa\Domain\Contracts\EmpresaRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var EmpresaRepositoryContract
     */
    private EmpresaRepositoryContract $repository;

    public function __construct( EmpresaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idEmpresa,
        string $nombre,
        string $ruc,
        string $direccion,
        ?string $idUbigeo,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idEmpresa = new Id($idEmpresa,false,'El id del Empresa no tiene el formato correcto');
        $_nombre = new Text($nombre, false,150,'El nombre de la empresa excede los 150 caracteres');
        $_ruc = new Text($ruc,false, 20,'El ruc de la empresa excede los 20 caracteres');
        $_direccion = new Text($direccion,true, 150,'La direccion de la Empresa excede los 150 caracteres');
        $_idUbigeo = new Text($idUbigeo,true, 6,'El id del ubigeo excede los 6 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idEmpresa,
            $_nombre,
            $_ruc,
            $_direccion,
            $_idUbigeo,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
