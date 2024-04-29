<?php

namespace Src\V2\Empresa\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Empresa\Domain\Contracts\EmpresaRepositoryContract;

final class CreateUseCase
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
        string $nombre,
        string $ruc,
        string $direccion,
        ?string $idUbigeo,
        string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'El nombre de la Empresa excede los 100 caracteres');
        $_ruc = new Text($ruc,false, 20,'El ruc de la empresa excede los 20 caracteres');
        $_direccion = new Text($direccion,true, 150,'La direccion de la Empresa excede los 150 caracteres');
        $_idUbigeo = new Text($idUbigeo,true, 6,'El id del ubigeo excede los 6 caracteres');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
            $_ruc,
            $_direccion,
            $_idUbigeo,
            $_idCliente,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
