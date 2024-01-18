<?php

namespace Src\V2\MotivoTraslado\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\MotivoTraslado\Domain\Contracts\MotivoTrasladoRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var MotivoTrasladoRepositoryContract
     */
    private MotivoTrasladoRepositoryContract $repository;

    public function __construct( MotivoTrasladoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idMotivoTraslado,
        string $nombre,
        string $link,
        string $icono,
        string $codigo,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idMotivoTraslado = new Id($idMotivoTraslado,false,'El id del MotivoTraslado no tiene el formato correcto');
        $_nombre = new Text($nombre,false, 100,'El nombre de la MotivoTraslado excede los 100 caracteres');
        $_link = new Text($link,true, 255,'El link de la MotivoTraslado excede los 255 caracteres');
        $_icono = new Text($icono,false,150, 'El nombre del icono excede los 150 caracteres');
        $_codigo = new Text($codigo,false,15,'El código excede los 15 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idMotivoTraslado,
            $_nombre,
            $_link,
            $_icono,
            $_codigo,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
