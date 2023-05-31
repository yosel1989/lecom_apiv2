<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineModel\Application;

use Src\Cold\ColdMachineModel\Domain\Contracts\ColdMachineModelRepositoryContract;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMId;

final class RestoreUseCase
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
                $this->repository->restore(new CMMId($value));
            }

        }else{

            $this->repository->restore(new CMMId($id));

        }

    }
}
