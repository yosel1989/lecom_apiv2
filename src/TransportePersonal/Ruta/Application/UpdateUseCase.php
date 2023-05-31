<?php

namespace Src\TransportePersonal\Ruta\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\Ruta\Domain\Contracts\RutaRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var RutaRepositoryContract
     */
    private $repository;

    public function __construct( RutaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        int $idEstado,
        string $idUsuarioModifico,
        string $idCliente
    ): void
    {
        $id = new Id($id,false,'El id del Ruta no tiene el formato válido');
        $name = new Text($nombre,false, 100 ,'El nombre tiene más de 100 caracteres');
        $idStatus = new Numeric($idEstado,false);
        $idUserUpdated = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato válido');
        $idClient = new Id($idCliente,false,'El id del cliente no tiene el formato válido');

        $this->repository->update(
            $id,
            $name,
            $idStatus,
            $idUserUpdated,
            $idClient
        );

    }
}
