<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineModel\Application;

use Src\Cold\ColdMachineModel\Domain\Contracts\ColdMachineModelRepositoryContract;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMId;

final class DeleteUseCase
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
                $this->repository->delete(new CMMId($value));
            }

        }else{

            $this->repository->delete(new CMMId($id));

        }

    }
}
