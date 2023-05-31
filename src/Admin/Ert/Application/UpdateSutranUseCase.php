<?php


namespace Src\Admin\Ert\Application;


use Src\Admin\Ert\Domain\Contracts\ErtRepositoryContract;
use Src\Admin\Ert\Domain\ValueObjects\ErtId;
use Src\Admin\Ert\Domain\ValueObjects\ErtSutran;

final class UpdateSutranUseCase
{
    /**
     * @var ErtRepositoryContract
     */
    private $repository;

    public function __construct( ErtRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        int $sutran
    ): void
    {
        $e_id = new ErtId($id);
        $e_sutran = new ErtSutran($sutran);

        $this->repository->updateSutran(
            $e_id,
            $e_sutran
        );

    }
}
