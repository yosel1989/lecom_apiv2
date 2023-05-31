<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlert\Application;

use Src\Cold\ColdMachineAlert\Domain\Contracts\ColdMachineAlertRepositoryContract;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAId;

final class TrashUseCase
{
    /**
     * @var ColdMachineAlertRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineAlertRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $this->repository->trash(new CMAId($value));
            }

        }else{

            $this->repository->trash(new CMAId($id));

        }

    }
}
