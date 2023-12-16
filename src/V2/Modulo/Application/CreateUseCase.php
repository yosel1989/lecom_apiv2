<?php

namespace Src\V2\Modulo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Modulo\Domain\Contracts\ModuloRepositoryContract;

final class CreateUseCase
{
    /**
     * @var ModuloRepositoryContract
     */
    private ModuloRepositoryContract $repository;

    public function __construct( ModuloRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $nombre,
        string $link,
        string $icono,
        string $codigo,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'El nombre de la modulo excede los 100 caracteres');
        $_link = new Text($link,true, 255,'El link de la modulo excede los 255 caracteres');
        $_icono = new Text($icono,false,150, 'El nombre del icono excede los 150 caracteres');
        $_codigo = new Text($codigo,false,15,'El código excede los 15 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
            $_link,
            $_icono,
            $_codigo,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
