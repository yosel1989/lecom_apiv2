<?php

namespace Src\Administracion\PersonalCategoria\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\PersonalCategoria\Domain\Contracts\PersonalCategoriaRepositoryContract;

final class CreateUseCase
{
    /**
     * @var PersonalCategoriaRepositoryContract
     */
    private $repository;

    public function __construct( PersonalCategoriaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        int $codigo,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $id = new Id($id,false,'El id del PersonalCategoria no tiene el formato valido');
        $name = new Text($nombre,false, 100 ,'El nombre tiene mas de 100 caracteres');
        $code = new Numeric($codigo,false);
        $idStatus = new Numeric($idEstado,false);
        $idUserRegistered = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');

        $this->repository->create(
            $id,
            $name,
            $code,
            $idStatus,
            $idUserRegistered
        );

    }
}
