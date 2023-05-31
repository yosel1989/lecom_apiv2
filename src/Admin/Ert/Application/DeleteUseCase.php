<?php

declare(strict_types=1);

namespace Src\Admin\Ert\Application;

use Src\Admin\Ert\Domain\Contracts\ErtRepositoryContract;
use Src\Admin\Ert\Domain\ValueObjects\ErtId;

final class DeleteUseCase
{
    /**
     * @var ErtRepositoryContract
     */
    private $repository;

    public function __construct(ErtRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $g_id = new ErtId($value);
                $this->repository->delete($g_id);
            }

        }else{

            $g_id = new ErtId($id);
            $this->repository->delete($g_id);

        }

    }
}
