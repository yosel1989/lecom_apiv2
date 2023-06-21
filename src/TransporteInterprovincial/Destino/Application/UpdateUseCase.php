<?php

declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Application;

use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\TransporteInterprovincial\Destino\Domain\Contracts\DestinoRepositoryContract;
use Src\Core\Domain\ValueObjects\Id;


final class UpdateUseCase
{
    /**
     * @var DestinoRepositoryContract
     */
    private DestinoRepositoryContract $repository;

    public function __construct(DestinoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        float $precioBase,
        string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $this->repository->update(
            new Id( $id, false, 'El formato del id no es valido'),
            new Text($nombre,false,250, 'El nombre del destino excede los 250 caracteres'),
            new NumericFloat($precioBase),
            new NumericInteger($idEstado),
            new Id($idCliente,false,'El formato del id del cliente no es valido'),
            new Id($idUsuarioRegistro, false, 'El formato del id del cliente no es valido')
        );
    }
}
