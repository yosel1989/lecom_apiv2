<?php

namespace Src\Administracion\MotivoAnulacion\Domain\Contracts;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\MotivoAnulacion\Domain\MotivoAnulacion;

interface MotivoAnulacionRepositoryContract
{
    public function find(Id $id): ?MotivoAnulacion;

    public function create(
        Id $id,
        Text $nombre,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function update(
        Id $id,
        Text $nombre,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collection(): array;
    public function list(): array;
}
