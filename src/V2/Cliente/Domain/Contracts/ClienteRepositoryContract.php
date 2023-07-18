<?php

namespace Src\V2\Cliente\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Cliente\Domain\Cliente;

interface ClienteRepositoryContract
{
    public function create(
        NumericInteger $_idTipoDocumento,
        Text $_numeroDocumento,
        Text $_nombre,
        Text $_nombreContacto,
        Text $_correo,
        Text $_direccion,
        Text $_telefono1,
        Text $_telefono2,
        NumericInteger $_idTipo,
        Id $_idCliente,
        NumericInteger $_idEstado,
        Id $_idUsuarioRegistro
    ): void;
    public function collectionByCliente(Id $idCliente): array;
    public function listByCliente(Id $idCliente): array;

    public function update(
        Id $idCliente,
        NumericInteger $_idTipoDocumento,
        Text $_numeroDocumento,
        Text $_nombre,
        Text $_nombreContacto,
        Text $_correo,
        Text $_direccion,
        Text $_telefono1,
        Text $_telefono2,
        NumericInteger $_idEstado,
        Id $_idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idCliente,
    ): Cliente;
}
