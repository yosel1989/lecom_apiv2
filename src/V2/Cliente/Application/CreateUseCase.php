<?php

namespace Src\V2\Cliente\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Cliente\Domain\Contracts\ClienteRepositoryContract;

final class CreateUseCase
{
    /**
     * @var ClienteRepositoryContract
     */
    private ClienteRepositoryContract $repository;

    public function __construct( ClienteRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?int $idTipoDocumento,
        string $numeroDocumento,
        ?string $nombre,
        ?string $nombreContacto,
        ?string $correo,
        ?string $direccion,
        ?string $telefono1,
        ?string $telefono2,
        int $idTipo,
        ?string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idTipoDocumento = new NumericInteger($idTipoDocumento);
        $_numeroDocumento = new Text($numeroDocumento,false,25, 'El número de documento excede los 25 caracteres');
        $_nombre = new Text($nombre,true,150, 'El nombre del cliente excede los 150 caracteres');
        $_nombreContacto = new Text($nombreContacto,true,150, 'El nombre del contacto excede los 150 caracteres');
        $_correo = new Text($correo,true,150, 'El correo excede los 150 caracteres');
        $_direccion = new Text($direccion,true,150, 'La dirección excede los 150 caracteres');
        $_telefono1 = new Text($telefono1,true,15, 'El telefono1 excede los 15 caracteres');
        $_telefono2 = new Text($telefono2,true,15, 'El telefono2 excede los 15 caracteres');
        $_idTipo = new NumericInteger($idTipo);
        $_idCliente = new Id($idCliente,true, 'El id del cliente padre tiene un formato incorrecto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_idTipoDocumento,
            $_numeroDocumento,
            $_nombre,
            $_nombreContacto,
            $_correo,
            $_direccion,
            $_telefono1,
            $_telefono2,
            $_idTipo,
            $_idCliente,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
