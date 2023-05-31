<?php

namespace Src\Administracion\PersonalCategoria\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\PersonalCategoria\Domain\Contracts\PersonalCategoriaRepositoryContract;

final class UpdateUseCase
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
        string $idUsuarioModifico
    ): void
    {
        $id = new Id($id,false,'El id del PersonalCategoria no tiene el formato válido');
        $name = new Text($nombre,false, 100 ,'El nombre tiene más de 100 caracteres');
        $code = new Numeric($codigo,false);
        $idStatus = new Numeric($idEstado,false);
        $idUserUpdated = new Id($idUsuarioModifico,false,'El id del usuario que modifico no tiene el formato válido');

        $this->repository->update(
            $id,
            $name,
            $code,
            $idStatus,
            $idUserUpdated
        );

    }
}
