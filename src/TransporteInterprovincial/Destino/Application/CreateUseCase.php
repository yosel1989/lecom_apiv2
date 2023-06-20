<?php

declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Application;

use Src\Core\Domain\ValueObjects\Text;
use Src\TransporteInterprovincial\Destino\Domain\Contracts\DestinoRepositoryContract;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoPlate;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoUnit;
use Src\TransporteInterprovincial\Destino\Domain\Destino;
use Src\Core\Domain\ValueObjects\Id;

final class CreateUseCase
{
    /**
     * @var DestinoRepositoryContract
     */
    private $repository;

    public function __construct( DestinoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        string $idCliente,
        string $idUsuarioRegistro
    ): ?Destino
    {
        return $this->repository->create(
            new Id( $id ),
            new Text( $nombre, false, 250,"" ),
            new DestinoUnit( $unidad ),
            new Id( $idCliente, true ),
            new Id( $idCategoria, true ),
            new Id( $idMarca, true ),
            new Id( $idModelo, true ),
            new Id( $idClase, true ),
            new Id( $idFlota, true )
        );
    }
}
