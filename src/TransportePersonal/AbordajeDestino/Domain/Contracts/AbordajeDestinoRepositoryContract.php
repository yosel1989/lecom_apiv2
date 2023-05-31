<?php


namespace Src\TransportePersonal\AbordajeDestino\Domain\Contracts;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Text;

interface AbordajeDestinoRepositoryContract
{

    public function create(
            Id $id,
            Id $idVehiculo,
         Text $matricula,
         Id $idRuta,
         Id $idTipoRuta,
         Id $idParaderoAbordaje,
         Id $idParaderoDestino,
         Id $idCliente,
         Text $hora
    ): void;

}
