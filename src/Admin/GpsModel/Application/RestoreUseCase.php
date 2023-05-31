<?php

declare(strict_types=1);

namespace Src\Admin\GpsModel\Application;

use Src\Admin\GpsModel\Domain\Contracts\GpsModelRepositoryContract;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelId;

final class RestoreUseCase
{
    /**
     * @var GpsModelRepositoryContract
     */
    private $repository;

    public function __construct(GpsModelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $g_id = new GpsModelId($value);
                $this->repository->restore($g_id);
            }

        }else{

            $g_id = new GpsModelId($id);
            $this->repository->restore($g_id);

        }

    }
}
