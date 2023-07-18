<?php

namespace Src\V2\Cliente\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Cliente\Domain\Contracts\ClienteRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var ClienteRepositoryContract
     */
    private ClienteRepositoryContract $repository;

    public function __construct( ClienteRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    /**
     * @param string $idCliente
     * @param int|null $idTipoDocumento
     * @param string $numeroDocumento
     * @param string|null $nombre
     * @param string|null $nombreContacto
     * @param string|null $correo
     * @param string|null $direccion
     * @param string|null $telefono1
     * @param string|null $telefono2
     * @param int $idEstado
     * @param string $idUsuarioRegistro
     * @return void
     */
    public function __invoke(
        string $idCliente,
        int | null $idTipoDocumento,
        string $numeroDocumento,
        string | null $nombre,
        string | null $nombreContacto,
        string | null $correo,
        string | null $direccion,
        string | null $telefono1,
        string | null $telefono2,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idCliente = new Id($idCliente,true, 'El id del cliente tiene un formato incorrecto');
        $_idTipoDocumento = new NumericInteger($idTipoDocumento);
        $_numeroDocumento = new Text($numeroDocumento,false,25, 'El número de documento excede los 25 caracteres');
        $_nombre = new Text($nombre,true,150, 'El nombre del cliente excede los 150 caracteres');
        $_nombreContacto = new Text($nombreContacto,true,150, 'El nombre del contacto excede los 150 caracteres');
        $_correo = new Text($correo,true,150, 'El correo excede los 150 caracteres');
        $_direccion = new Text($direccion,true,150, 'La dirección excede los 150 caracteres');
        $_telefono1 = new Text($telefono1,true,15, 'El telefono1 excede los 15 caracteres');
        $_telefono2 = new Text($telefono2,true,15, 'El telefono2 excede los 15 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idCliente,
            $_idTipoDocumento,
            $_numeroDocumento,
            $_nombre,
            $_nombreContacto,
            $_correo,
            $_direccion,
            $_telefono1,
            $_telefono2,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
