<?php

declare(strict_types=1);

namespace Src\Admin\Module\Application;

use Src\Admin\Module\Domain\Contracts\ModuleRepositoryContract;
use Src\Admin\Module\Domain\ValueObjects\ModuleId;

final class DeleteUseCase
{
    /**
     * @var ModuleRepositoryContract
     */
    private $repository;

    public function __construct(ModuleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $b_id = new ModuleId($value);
                $this->repository->delete($b_id);
            }

        }else{

            $b_id = new ModuleId($id);
            $this->repository->delete($b_id);

        }

    }
}
