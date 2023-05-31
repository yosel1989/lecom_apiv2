<?php


namespace Src\Administracion\Personal\Domain\Contracts;


use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Personal\Domain\Personal;

interface PersonalRepositoryContract
{
    public function find(Id $id): ?Personal;

    public function create(
         Id $id,
         Text $nombre,
         Text $apellido,
         Text $documentoIdentidad,
         DateOnlyFormat $fechaNacimiento,
         Id $idCategoriaPersonal,
         Id $idCliente,
         Numeric $idEstado,
         Id $idUsuarioRegistro
    ): void;

    public function update(
        Id $id,
        Text $nombre,
        Text $apellido,
        Text $documentoIdentidad,
        DateOnlyFormat $fechaNacimiento,
        Id $idCategoriaPersonal,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByClient(Id $idCliente): array;

    public function collectionByClientByCategory(Id $idCliente, Numeric $codeCategory): array;

}
