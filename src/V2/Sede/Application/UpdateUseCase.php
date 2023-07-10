<?php

namespace Src\V2\Sede\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Sede\Domain\Contracts\SedeRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var SedeRepositoryContract
     */
    private SedeRepositoryContract $repository;

    public function __construct( SedeRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idSede,
        string $nombre,
        ?string $direccion,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idSede = new Id($idSede,false,'El id del sede no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del sede excede los 100 caracteres');
        $_direccion = new Text($direccion,true, 150,'La direccion de la sede excede los 150 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idSede,
            $_nombre,
            $_direccion,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
