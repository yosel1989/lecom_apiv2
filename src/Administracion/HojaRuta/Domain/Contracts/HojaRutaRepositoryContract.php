<?php


namespace Src\Administracion\HojaRuta\Domain\Contracts;


use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\HojaRuta\Domain\HojaRuta;
use Src\ModelBase\Domain\ValueObjects\TimeFormat;

interface HojaRutaRepositoryContract
{
    public function find(Id $id): ?HojaRuta;

    public function create(
        Id $id,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idRuta,
        DateOnlyFormat $fechaAsignada,
        TimeFormat $horaAsignada,
        Text $urlHojaRuta,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function update(
        Id $id,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idRuta,
        DateOnlyFormat $fechaAsignada,
        TimeFormat $horaAsignada,
        Text $urlHojaRuta,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByClient(Id $idCliente): array;
    public function collectionByClientByDate(Id $idCliente, DateOnlyFormat $fechaAsignada): array;


}
