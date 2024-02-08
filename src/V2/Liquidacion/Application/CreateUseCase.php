<?php

namespace Src\V2\Liquidacion\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
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
        string $idSede,
        array $idVehiculos,
        ?string $idPersonal,
        string $fechaInicio,
        string $fechaFin,
        string $archivo,
        string $urlArchivo,
//        int $idEstado,
        string $idUsuarioRegistro,
        bool $local,
        float $monto
    ): void
    {

        $_id = new Id($id,false, 'El id del Liquidacion no tiene el formato correcto');
        $_codigo = new NumericInteger($codigo);
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false,'El id de la sede no tiene el formato correcto');
        $_idPersonal = new Id($idPersonal,true,'El id del personal no tiene el formato correcto');
        $_fechaInicio = new DateFormat($fechaInicio,false,'La fecha inicio no tiene el formato correcto');
        $_fechaFin = new DateFormat($fechaFin,false,'La fecha fin no tiene el formato correcto');
        $_archivo = new Text($archivo,false,250, 'El nombre del archivo excede los 250 caracteres');
        $_urlArchivo = new Text($urlArchivo,false,500, 'La ruta del archivo excede los 500 caracteres');
//        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');
        $_local = new ValueBoolean($local);
        $_monto = new NumericFloat($monto);

        $this->repository->create(
            $_id,
            $_codigo,
            $_idCliente,
            $_idSede,
            $idVehiculos,
            $_idPersonal,
            $_fechaInicio,
            $_fechaFin,
            $_archivo,
            $_urlArchivo,
//            $_idEstado,
            $_idUsuarioRegistro,
            $_local,
            $_monto
        );

    }
}
