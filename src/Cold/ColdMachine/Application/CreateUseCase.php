<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachine\Application;

use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachine\Domain\ColdMachine;
use Src\Cold\ColdMachine\Domain\Contracts\ColdMachineRepositoryContract;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdClient;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdModel;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdStatus;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMImei;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMMaxFuel;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMSetPoint;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMSim;

final class CreateUseCase
{
    /**
     * @var ColdMachineRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $imei,
        string $idModel,
        int $idStatus,
        int $setPoint,
        string $idClient,
        float $maxFuel,
        string $sim,
        string $idUserCreated
    ): ?ColdMachine
    {
        return $this->repository->create(
            new CMId( $id ),
            new CMImei( $imei ),
            new CMIdModel( $idModel ),
            new CMIdStatus( $idStatus ),
            new CMSetPoint( $setPoint ),
            new CMIdClient( $idClient ),
            new CMMaxFuel( $maxFuel ),
            new CMSim( $sim ),
            new UserId($idUserCreated)
        );
    }
}
