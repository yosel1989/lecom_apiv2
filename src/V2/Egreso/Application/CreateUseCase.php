<?php

namespace Src\V2\Egreso\Application;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Egreso\Domain\Contracts\EgresoRepositoryContract;

final class CreateUseCase
{
    /**
     * @var EgresoRepositoryContract
     */
    private EgresoRepositoryContract $repository;

    public function __construct( EgresoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idEgreso,
        string $idCliente,
        string $idEgresoTipo,
        string $fecha,
        array $detalle,
        float $total,
        string $idUsuarioRegistro
    ): void
    {
        $_idEgreso = new Id($idEgreso,false, 'El id del egreso no tiene el formato correcto');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idEgresoTipo = new Id($idEgresoTipo,false,'El id de la egreso tipo no tiene el formato correcto');
        $_fecha = new DateTimeFormat($fecha);
        $_total = new NumericFloat($total);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_idEgreso,
            $_idCliente,
            $_idEgresoTipo,
            $_fecha,
            $detalle,
            $_total,
            $_idUsuarioRegistro
        );

    }
}
