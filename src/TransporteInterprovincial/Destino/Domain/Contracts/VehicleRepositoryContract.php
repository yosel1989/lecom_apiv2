<?php


namespace Src\TransporteInterprovincial\Destino\Domain\Contracts;

use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoPlate;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoUnit;
use Src\TransporteInterprovincial\Destino\Domain\Destino;
use Src\Core\Domain\ValueObjects\Id;

interface DestinoRepositoryContract
{
    public function create(
        Id $id,
        DestinoPlate $placa,
        DestinoUnit $unidad,
        Id $idCliente,
        Id $idCategoria,
        Id $idMarca,
        Id $idModelo,
        Id $idClase,
        Id $idFlota ): ?Destino;
    public function update(
        Id $id,
        DestinoPlate $placa,
        DestinoUnit $unidad,
        Id $idCategoria,
        Id $idMarca,
        Id $idModelo,
        Id $idClase,
        Id $idFlota
    ): ?Destino;
    public function find(
        Id $idVehiculo
    ): ?Destino;
    public function trash( Id $idVehiculo ): void;
    public function delete( Id $idVehiculo ): void;
    public function restore( Id $idVehiculo ): void;
    public function collectionByClient(Id $idCliente): array;
    public function collectionActivedByClient(Id $idCliente): array;
}
