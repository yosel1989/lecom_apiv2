<?php

declare(strict_types=1);

namespace Src\Admin\Module\Application;

use Src\Admin\Module\Domain\Contracts\ModuleRepositoryContract;
use Src\Admin\Module\Domain\ValueObjects\ModuleId;
use Src\Admin\Module\Domain\ValueObjects\ModuleName;
use Src\Admin\Module\Domain\Module;
use Src\Admin\Module\Domain\ValueObjects\ModuleShortName;

final class UpdateUseCase
{
    /**
     * @var ModuleRepositoryContract
     */
    private $repository;

    public function __construct(ModuleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $name, string $shortName ): ?Module
    {
        $m_id = new ModuleId($id);
        $m_name = new ModuleName($name);
        $m_shortname = new ModuleShortName($shortName);
        return $this->repository->update($m_id,$m_name,$m_shortname);
    }
}
