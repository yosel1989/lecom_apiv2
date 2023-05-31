<?php

namespace Src\TransportePersonal\Paradero\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\Paradero\Domain\Contracts\ParaderoRepositoryContract;

final class UpdateUseCase
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
        string $idUsuarioModifico,
        string $idCliente
    ): void
    {
        $id = new Id($id,false,'El id del paradero no tiene el formato válido');
        $name = new Text($nombre,false, 100 ,'El nombre tiene más de 100 caracteres');
        $shortName = new Text($nombreCorto,true, 50 ,'El nombre corto tiene más de 50 caracteres');
        $idStatus = new Numeric($idEstado,false);
        $idUserUpdated = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato válido');
        $idClient = new Id($idCliente,false,'El id del cliente no tiene el formato válido');

        $this->repository->update(
            $id,
            $name,
            $shortName,
            $idStatus,
            $idUserUpdated,
            $idClient
        );

    }
}
