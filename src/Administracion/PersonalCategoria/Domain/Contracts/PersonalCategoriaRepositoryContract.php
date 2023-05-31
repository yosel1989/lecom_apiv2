<?php


namespace Src\Administracion\PersonalCategoria\Domain\Contracts;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\PersonalCategoria\Domain\PersonalCategoria;

interface PersonalCategoriaRepositoryContract
{
    public function find(Id $id): ?PersonalCategoria;

    public function create(
         Id $id,
         Text $nombre,
         Numeric $codigo,
         Numeric $idEstado,
         Id $idUsuarioRegistro
    ): void;

    public function update(
        Id $id,
        Text $nombre,
        Numeric $codigo,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collection(): array;

    public function collectionActived(): array;


}
