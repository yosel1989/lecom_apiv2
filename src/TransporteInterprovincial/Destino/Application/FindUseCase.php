<?php

declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Application;

use Src\TransporteInterprovincial\Destino\Domain\Contracts\DestinoRepositoryContract;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoId;
use Src\TransporteInterprovincial\Destino\Domain\Destino;
use Src\Core\Domain\ValueObjects\Id;

final class FindUseCase
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
        string $idVehiculo
    ): ?Destino
    {
        return $this->repository->find(
            new Id( $idVehiculo )
        );
    }
}
