<?php

declare(strict_types=1);

namespace Src\Admin\GpsModel\Domain;


use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelDeleted;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelId;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelInput;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelName;
use Src\Admin\GpsModel\Domain\ValueObjects\GpsModelOutput;

final class GpsModel
{
    /**
     * @var GpsModelId
     */
    private $id;
    /**
     * @var GpsModelName
     */
    private $name;
    /**
     * @var GpsModelDeleted
     */
    private $deleted;
    /**
     * @var GpsModelInput
     */
    private $input;
    /**
     * @var GpsModelOutput
     */
    private $output;

    /**
     * GpsModel constructor.
     * @param GpsModelId $id
     * @param GpsModelName $name
     * @param GpsModelInput $input
     * @param GpsModelOutput $output
     * @param GpsModelDeleted $deleted
     */
    public function __construct(
        GpsModelId  $id,
        GpsModelName $name,
        GpsModelInput $input,
        GpsModelOutput $output,
        GpsModelDeleted $deleted
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->deleted = $deleted;
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @return GpsModelId
     */
    public function getId(): GpsModelId
    {
        return $this->id;
    }

    /**
     * @return GpsModelName
     */
    public function getName(): GpsModelName
    {
        return $this->name;
    }

    /**
     * @return GpsModelInput
     */
    public function getInput(): GpsModelInput
    {
        return $this->input;
    }

    /**
     * @return GpsModelOutput
     */
    public function getOutput(): GpsModelOutput
    {
        return $this->output;
    }



    /**
     * @return GpsModelDeleted
     */
    public function getDeleted(): GpsModelDeleted
    {
        return $this->deleted;
    }


    public static function createEntity( $request ): GpsModel
    {
        return new self(
            new GpsModelId ($request->id),
            new GpsModelName($request->name),
            new GpsModelInput($request->number_input),
            new GpsModelOutput($request->number_output),
            new GpsModelDeleted($request->deleted)
        );
    }

}
