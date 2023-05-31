<?php

namespace Src\TransportePersonal\AbordajeDestino\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\AbordajeDestino\Domain\Contracts\AbordajeDestinoRepositoryContract;

final class CreateUseCase
{
    /**
     * @var AbordajeDestinoRepositoryContract
     */
    private $repository;

    public function __construct( AbordajeDestinoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        ?string $idVehiculo,
        string $matricula,
        string $idCliente,
        ?string $idRuta,
        string $idTipoRuta,
        string $idParaderoAbordaje,
        string $idParaderoDestino,
        ?string $hora
    ): void
    {
        $Id = new Id($id,false,'El id del AbordajeDestino no tiene el formato valido');
        $IdVehiculo = new Id($id,true,'El id del vehiculo no tiene el formato valido');
        $Matricula = new Text($matricula,false, 100 ,'La matricula tiene mas de 100 caracteres');
        $IdCliente = new Id($idCliente,false,'El id del cliente no tiene el formato valido');
        $IdRuta = new Id($idRuta,true,'El id de la ruta no tiene el formato valido');
        $IdTipoRuta = new Id($idTipoRuta,false,'El id del tipo de ruta no tiene el formato valido');
        $IdParaderoAbordaje = new Id($idParaderoAbordaje,false,'El id del paradero abordaje no tiene el formato valido');
        $IdParaderoDestino = new Id($idParaderoDestino,false,'El id del paradero destino no tiene el formato valido');
        $Hora = new Text($hora,true,8,'La hora no tiene el formato correcto');

        $this->repository->create(
            $Id,
            $IdVehiculo,
            $Matricula,
            $IdRuta,
            $IdTipoRuta,
            $IdParaderoAbordaje,
            $IdParaderoDestino,
            $IdCliente,
            $Hora
        );

    }
}
