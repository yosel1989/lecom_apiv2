<?php

namespace Src\Administracion\Ruta\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Ruta\Domain\Contracts\RutaRepositoryContract;

final class CreateUseCase
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
        string $idUsuarioRegistro,
        string $idCliente
    ): void
    {
        $id = new Id($id,false,'El id del Ruta no tiene el formato valido');
        $name = new Text($nombre,false, 150 ,'El nombre tiene mas de 150 caracteres');
        $code = new Text($codigo,false, 150 ,'El codigo tiene mas de 15 caracteres');
        $idStatus = new Numeric($idEstado,false);
        $idUserRegistered = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');
        $idClient = new Id($idCliente,false,'El id del cliente no tiene el formato valido');

        $this->repository->create(
            $id,
            $name,
            $code,
            $idStatus,
            $idUserRegistered,
            $idClient
        );

    }
}
