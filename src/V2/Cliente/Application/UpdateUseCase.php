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

    public function __invoke(
        string $idCliente,
        ?string $foto,
        string $nombre,
        string $apellido,
        ?string $idTipoDocumento,
        ?string $numeroDocumento,
        ?string $correo,
        ?string $idSede,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idCliente = new Id($idCliente,true,'El id del personal no tiene el formato correcto');
        $_foto = new Text($foto,true, 99999,'La foto excede el maximo de caracteres');
        $_nombre = new Text($nombre,false, 150,'El nombre excede los 150 caracteres');
        $_apellido = new Text($apellido,false, 150,'El apellido excede los 150 caracteres');
        $_idTipoDocumento = new Id($idTipoDocumento,true,'El id del tipo de documento no tiene el formato correcto');
        $_numeroDocumento = new Text($numeroDocumento,true, 150,'El numero de documento excede los 150 caracteres');
        $_correo = new Text($correo,true, 150,'El correo excede los 150 caracteres');
        $_idSede = new Id($idSede,true,'El id de la sede no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idCliente,
            $_foto,
            $_nombre,
            $_apellido,
            $_idTipoDocumento,
            $_numeroDocumento,
            $_correo,
            $_idSede,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
