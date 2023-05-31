<?php

namespace Src\Administracion\Egreso\Application;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Egreso\Domain\Contracts\EgresoRepositoryContract;

final class CreateUseCase
{
    /**
     * @var EgresoRepositoryContract
     */
    private $repository;

    public function __construct( EgresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $fecha,
        string $idTipoEgreso,
        ?string $idVehiculo,
        ?string $idPersonal,
        ?string $idRuta,
        string $idCliente,
        float $monto,
        ?string $observacion,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $Id = new Id($id,false,'El id del Egreso no tiene el formato valido');
        $Fecha = new DateOnlyFormat($fecha,false,'La fecha tiene un formato invalido');
        $IdTipoEgreso = new Id($idTipoEgreso,false,'El id del tipo de Egreso no tiene el formato valido');
        $IdVehiculo = new Id($idVehiculo,true,'El id del vehiculo no tiene el formato valido');
        $IdPersonal = new Id($idPersonal,true,'El id del personal no tiene el formato valido');
        $IdRuta = new Id($idRuta,true,'El id de la ruta no tiene el formato valido');
        $IdCliente = new Id($idCliente,false,'El id del cliente no tiene el formato valido');
        $Observacion = new Text($observacion,true, 250,'La observación excede los 250 caracteres');
        $IdEstado = new Numeric($idEstado,false);
        $Monto = new Numeric($monto,false);
        $IdUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');


        $this->repository->create(
            $Id,
            $Fecha,
            $IdTipoEgreso,
            $IdVehiculo,
            $IdPersonal,
            $IdRuta,
            $Monto,
            $Observacion,
            $IdCliente,
            $IdEstado,
            $IdUsuarioRegistro
        );

    }
}
