<?php

namespace Src\Administracion\Ruta\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Ruta\Domain\Contracts\RutaRepositoryContract;

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
        string $codigo,
        int $idEstado,
        string $idUsuarioModifico,
        string $idCliente
    ): void
    {
        $id = new Id($id,false,'El id del Ruta no tiene el formato válido');
        $name = new Text($nombre,false, 100 ,'El nombre tiene más de 150 caracteres');
        $code = new Text($codigo,false, 150 ,'El codigo tiene mas de 15 caracteres');
        $idStatus = new Numeric($idEstado,false);
        $idUserUpdated = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato válido');
        $idClient = new Id($idCliente,false,'El id del cliente no tiene el formato válido');

        $this->repository->update(
            $id,
            $name,
            $code,
            $idStatus,
            $idUserUpdated,
            $idClient
        );

    }
}
