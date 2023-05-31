<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineModel\Application;

use Src\Cold\ColdMachineModel\Domain\Contracts\ColdMachineModelRepositoryContract;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMId;

final class TrashUseCase
{
    /**
     * @var ColdMachineModelRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineModelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $this->repository->trash(new CMMId($value));
            }

        }else{

            $this->repository->trash(new CMMId($id));

        }

    }
}
