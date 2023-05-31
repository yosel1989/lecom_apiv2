<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineModel\Application;

use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachineModel\Domain\ColdMachineModel;
use Src\Cold\ColdMachineModel\Domain\Contracts\ColdMachineModelRepositoryContract;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMCode;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMId;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMIdType;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMName;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMShortName;

final class CreateUseCase
{
    /**
     * @var ColdMachineModelRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineModelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $name,
        string $shortname,
        int $idType,
        int $code,
        string $idUserCreated
    ): ?ColdMachineModel
    {
        return $this->repository->create(
            new CMMId( $id ),
            new CMMName( $name ),
            new CMMShortName( $shortname ),
            new CMMIdType( $idType ),
            new CMMCode($code),
            new UserId($idUserCreated)
        );
    }
}
