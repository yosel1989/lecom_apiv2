<?php

namespace Src\V2\Empresa\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Empresa\Domain\Empresa;

interface EmpresaRepositoryContract
{
    public function create(
        Text $nombre,
        Text $ruc,
        Text $direccion,
        Text $idUbigeo,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): array;
    public function listByCliente(Id $idCliente): array;

    public function update(
        Id $id,
        Text $nombre,
        Text $ruc,
        Text $direccion,
        Text $idUbigeo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idEmpresa,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idEmpresa,
    ): Empresa;

    public function changePredeterminado(
        Id $idCliente,
        Id $idEmpresa,
        Id $idUsuarioModifico
    ): void;
}
