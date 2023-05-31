<?php

declare(strict_types=1);

namespace Src\Admin\Gps\Application;

use Src\Admin\Gps\Domain\Contracts\GpsRepositoryContract;
use Src\Admin\Gps\Domain\ValueObjects\GpsId;

final class DeleteUseCase
{
    /**
     * @var GpsRepositoryContract
     */
    private $repository;

    public function __construct(GpsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $g_id = new GpsId($value);
                $this->repository->delete($g_id);
            }

        }else{

            $g_id = new GpsId($id);
            $this->repository->delete($g_id);

        }

    }
}
