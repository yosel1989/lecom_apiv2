<?php

namespace Src\V2\Serie\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Serie\Domain\Contracts\SerieRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var SerieRepositoryContract
     */
    private SerieRepositoryContract $repository;

    public function __construct( SerieRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idSerie,
        string $nombre,
        string | null $idSede,
        string $idTipo,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idSerie = new Id($idSerie,false,'El id del Serie no tiene el formato correcto');
        $_nombre = new Text($nombre,false, 100,'El nombre de la Serie excede los 100 caracteres');
        $_idSede = new Id($idSede,true,'El id de la sede no tiene el formato correcto');
        $_idTipo = new NumericInteger($idTipo);
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idSerie,
            $_nombre,
            $_idSede,
            $_idTipo,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
