<?php

namespace Src\Administracion\MotivoAnulacion\Application;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\MotivoAnulacion\Domain\Contracts\MotivoAnulacionRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var MotivoAnulacionRepositoryContract
     */
    private $repository;

    public function __construct( MotivoAnulacionRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        ?string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $Id = new Id($id,false,'El id del motivo no tiene el formato valido');
        $Nombre = new Text($nombre,false, 150,'El nombre del motivo excede los 150 caracteres');
        $IdCliente = new Id($idCliente,true,'El id del cliente no tiene el formato valido');
        $IdEstado = new Numeric($idEstado,false);
        $IdUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');


        $this->repository->update(
            $Id,
            $Nombre,
            $IdCliente,
            $IdEstado,
            $IdUsuarioRegistro
        );

    }
}
