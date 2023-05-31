<?php

namespace Src\TransportePersonal\TipoRuta\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\TipoRuta\Domain\Contracts\TipoRutaRepositoryContract;

final class CreateUseCase
{
    /**
     * @var TipoRutaRepositoryContract
     */
    private $repository;

    public function __construct( TipoRutaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        int $idEstado,
        string $idUsuarioRegistro,
        string $idCliente
    ): void
    {
        $id = new Id($id,false,'El id del TipoRuta no tiene el formato valido');
        $name = new Text($nombre,false, 100 ,'El nombre tiene mas de 100 caracteres');
        $idStatus = new Numeric($idEstado,false);
        $idUserRegistered = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');
        $idClient = new Id($idCliente,false,'El id del cliente no tiene el formato valido');

        $this->repository->create(
            $id,
            $name,
            $idStatus,
            $idUserRegistered,
            $idClient
        );

    }
}
