<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachine\Application;

use Src\Cold\ColdMachine\Domain\Contracts\ColdMachineRepositoryContract;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;

final class RestoreUseCase
{
    /**
     * @var ColdMachineRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $this->repository->restore(new CMId($value));
            }

        }else{

            $this->repository->restore(new CMId($id));

        }

    }
}
