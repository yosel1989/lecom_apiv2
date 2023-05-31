<?php

declare(strict_types=1);

namespace Src\Admin\Module\Domain;


use Src\Admin\Module\Domain\ValueObjects\ModuleId;
use Src\Admin\Module\Domain\ValueObjects\ModuleName;
use Src\Admin\Module\Domain\ValueObjects\ModuleShortName;

final class Module
{
    /**
     * @var ModuleId
     */
    private $id;
    /**
     * @var ModuleName
     */
    private $name;
    /**
     * @var ModuleShortName
     */
    private $shortName;

    /**
     * Module constructor.
     * @param ModuleId $id
     * @param ModuleName $name
     * @param ModuleShortName $shortName
     */
    public function __construct(
        ModuleId  $id,
        ModuleName $name,
        ModuleShortName $shortName
    )
    {

        $this->id = $id;
        $this->name = $name;
        $this->shortName = $shortName;
    }

    /**
     * @return ModuleId
     */
    public function getId(): ModuleId
    {
        return $this->id;
    }

    /**
     * @return ModuleName
     */
    public function getName(): ModuleName
    {
        return $this->name;
    }

    /**
     * @return ModuleShortName
     */
    public function getShortName(): ModuleShortName
    {
        return $this->shortName;
    }

    public static function createEntity( $request ): Module
    {
        return new self(
            new ModuleId ($request->id),
            new ModuleName($request->name),
            new ModuleShortName($request->short_name)
        );
    }

}
