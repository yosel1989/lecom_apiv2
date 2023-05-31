<?php

namespace Src\Administracion\TipoIngreso\Application;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\TipoIngreso\Domain\Contracts\TipoIngresoRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\TimeFormat;

final class UpdateUseCase
{
    /**
     * @var TipoIngresoRepositoryContract
     */
    private $repository;

    public function __construct( TipoIngresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        ?string $descripcion,
        int $registraVehiculo,
        int $registraPersonal,
        int $registraRuta,
        string $idCliente,
        int $idEstado,
        string $idUsuarioModifico
    ): void
    {
        $Id = new Id($id,false,'El id de la hoja de ruta no tiene el formato valido');
        $Name = new Text($nombre,false, 100,'El nombre excede los 150 caracteres');
        $Description = new Text($descripcion,true, 250, 'La descripcion excede los 250 caracteres');
        $HasVehicle = new Numeric($registraVehiculo,false);
        $HasPersonal = new Numeric($registraPersonal,false);
        $HasRoute = new Numeric($registraRuta,false );
        $IdClient = new Id($idCliente,false,'El id del cliente no tiene el formato valido');
        $idStatus = new Numeric($idEstado,false);
        $idUserRegistered = new Id($idUsuarioModifico,false,'El id del usuario que registro no tiene el formato valido');

        $this->repository->update(
            $Id,
            $Name,
            $Description,
            $HasVehicle,
            $HasPersonal,
            $HasRoute,
            $IdClient,
            $idStatus,
            $idUserRegistered
        );

    }
}
