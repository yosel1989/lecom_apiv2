<?php

namespace Src\Administracion\Ingreso\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Ingreso\Domain\Contracts\IngresoRepositoryContract;

final class AnularUseCase
{
    /**
     * @var IngresoRepositoryContract
     */
    private $repository;

    public function __construct( IngresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $idMotivo,
        ?string $detalle,
        string $idUsuarioRegistro
    ): void
    {
        $Id = new Id($id,false,'El id del ingreso no tiene el formato valido');
        $IdMotivo = new Id($idMotivo,false,'El id del motivo de anulación no tiene el formato valido');
        $Detalle = new Text($detalle,true, 250,'El detalle excede los 250 caracteres');
        $IdUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');


        $this->repository->cancel(
            $Id,
            $IdMotivo,
            $Detalle,
            $IdUsuarioRegistro
        );

    }
}
