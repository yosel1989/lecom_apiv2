<?php

declare(strict_types=1);

namespace Src\Admin\Gps\Application;

use Src\Admin\Gps\Domain\Contracts\GpsRepositoryContract;
use Src\Admin\Gps\Domain\ValueObjects\GpsId;
use Src\Admin\Gps\Domain\ValueObjects\GpsIdModel;
use Src\Admin\Gps\Domain\ValueObjects\GpsImei;
use Src\Admin\Gps\Domain\Gps;
use Src\Admin\Gps\Domain\ValueObjects\GpsType;

final class UpdateUseCase
{
    /**
     * @var GpsRepositoryContract
     */
    private $repository;

    public function __construct(GpsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $imei, string $model, int $type ): ?Gps
    {
        $g_id = new GpsId($id);
        $g_imei = new GpsImei($imei);
        $g_model = new GpsIdModel($model);
        $g_type = new GpsType($type);
        return $this->repository->update( $g_id, $g_imei, $g_model, $g_type );
    }
}
