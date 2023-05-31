<?php

declare(strict_types=1);

namespace Src\Admin\GpsModel\Application;

use Src\Admin\GpsModel\Domain\Contracts\GpsModelRepositoryContract;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelId;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelInput;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelName;
use Src\Admin\GpsModel\Domain\GpsModel;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelOutput;

final class CreateUseCase
{
    /**
     * @var GpsModelRepositoryContract
     */
    private $repository;

    public function __construct(GpsModelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $name, int $input, int $output ): ?GpsModel
    {
        $g_id = new GpsModelId($id);
        $g_name = new GpsModelName($name);
        $g_input = new GpsModelInput($input);
        $g_output = new GpsModelOutput($output);
        return $this->repository->create($g_id,$g_name,$g_input,$g_output);
    }
}
