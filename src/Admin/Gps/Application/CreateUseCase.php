<?php

declare(strict_types=1);

namespace Src\Admin\Gps\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Gps\Domain\Contracts\GpsRepositoryContract;
use Src\Admin\Gps\Domain\ValueObjects\GpsId;
use Src\Admin\Gps\Domain\Gps;
use Src\Admin\Gps\Domain\ValueObjects\GpsIdModel;
use Src\Admin\Gps\Domain\ValueObjects\GpsImei;
use Src\Admin\Gps\Domain\ValueObjects\GpsType;

final class CreateUseCase
{
    /**
     * @var GpsRepositoryContract
     */
    private $repository;

    public function __construct(GpsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $imei, string $model, int $type, string $idClient ): ?Gps
    {
        $g_id = new GpsId($id);
        $g_imei = new GpsImei($imei);
        $g_type = new GpsType($type);
        $g_client = new ClientId($idClient);
        $g_model = new GpsIdModel($model);
        return $this->repository->create( $g_id, $g_imei, $g_model, $g_type, $g_client );
    }
}
