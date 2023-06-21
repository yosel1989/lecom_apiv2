<?php


namespace Src\TransporteInterprovincial\Destino\Domain\Contracts;

use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\TransporteInterprovincial\Destino\Domain\Destino;
use Src\Core\Domain\ValueObjects\Id;

interface DestinoRepositoryContract
{
    public function create(
        Text $nombre,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idCliente,
        Id $idUsuarioRegistro
    ): void;

    public function update(
        Id $id,
        Text $nombre,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idCliente,
        Id $idUsuarioModifico
    ): void;

    public function find( Id $idDestino ): ?Destino;

    public function collectionByClient(Id $idCliente): array;
    public function listByClient(Id $idCliente): array;

    public function collectionActivedByClient(Id $idCliente): array;
}
