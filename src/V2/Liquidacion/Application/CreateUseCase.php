<?php

namespace Src\V2\Liquidacion\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;

final class CreateUseCase
{
    /**
     * @var LiquidacionRepositoryContract
     */
    private LiquidacionRepositoryContract $repository;

    public function __construct( LiquidacionRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        int $codigo,
        string $idCliente,
        array $idVehiculos,
        string $idPersonal,
        string $fechaInicio,
        string $fechaFin,
        string $archivo,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {

        $_id = new Id($id,false, 'El id del Liquidacion no tiene el formato correcto');
        $_codigo = new NumericInteger($codigo);
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idPersonal = new Id($idPersonal,true,'El id del personal no tiene el formato correcto');
        $_fechaInicio = new DateFormat($fechaInicio,false,'La fecha inicio no tiene el formato correcto');
        $_fechaFin = new DateFormat($fechaFin,false,'La fecha fin no tiene el formato correcto');
        $_archivo = new Text($archivo,false,500, 'La ruta del archivo excede los 500 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_id,
            $_codigo,
            $_idCliente,
            $_idPersonal,
            $_fechaInicio,
            $_fechaFin,
            $_archivo,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
