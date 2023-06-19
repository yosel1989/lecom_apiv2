<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Application;

use Src\Admin\Vehicle\Domain\Contracts\VehicleRepositoryContract;
use Src\Core\Domain\ValueObjects\Id;

final class DeleteUseCase
{
    /**
     * @var VehicleRepositoryContract
     */
    private $repository;

    public function __construct(VehicleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $g_id = new Id($value);
                $this->repository->delete($g_id);
            }

        }else{

            $g_id = new Id($id);
            $this->repository->delete($g_id);

        }

    }
}
