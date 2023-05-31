<?php

namespace Src\TransportePersonal\Paradero\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\Paradero\Domain\Contracts\ParaderoRepositoryContract;

final class CreateUseCase
{
    /**
     * @var ParaderoRepositoryContract
     */
    private $repository;

    public function __construct( ParaderoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        ?string $nombreCorto,
        int $idEstado,
        string $idUsuarioRegistro,
        string $idCliente
    ): void
    {
        $id = new Id($id,false,'El id del paradero no tiene el formato valido');
        $name = new Text($nombre,false, 100 ,'El nombre tiene mas de 100 caracteres');
        $shortName = new Text($nombreCorto,true, 50 ,'El nombre corto tiene mas de 50 caracteres');
        $idStatus = new Numeric($idEstado,false);
        $idUserRegistered = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');
        $idClient = new Id($idCliente,false,'El id del cliente no tiene el formato valido');

        $this->repository->create(
            $id,
            $name,
            $shortName,
            $idStatus,
            $idUserRegistered,
            $idClient
        );

    }
}
