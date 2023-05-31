<?php

declare(strict_types=1);

namespace Src\Admin\Ert\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Ert\Domain\Contracts\ErtRepositoryContract;
use Src\Admin\Ert\Domain\ValueObjects\ErtId;
use Src\Admin\Ert\Domain\Ert;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdGps;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdSim;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdType;
use Src\Admin\Ert\Domain\ValueObjects\ErtPeriod;
use Src\Admin\Ert\Domain\ValueObjects\ErtSutran;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;

final class CreateUseCase
{
    /**
     * @var ErtRepositoryContract
     */
    private $repository;

    public function __construct( ErtRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        int $period,
        int $sutran,
        string $idClient,
        string $idVehicle,
        ?string $idType,
        ?string $idGps,
        string $idSim
    ): ?Ert
    {
        return $this->repository->create(
            new ErtId( $id ),
            new ErtPeriod( $period ),
            new ErtSutran( $sutran ),
            new ClientId( $idClient ),
            new VehicleId( $idVehicle ),
            new ErtIdType( $idType ),
            new ErtIdGps( $idGps ),
            new ErtIdSim( $idSim )
        );
    }
}
