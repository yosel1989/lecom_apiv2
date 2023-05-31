<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Application;

use Src\Admin\SimCard\Domain\Contracts\SimCardRepositoryContract;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardId;

final class DeleteUseCase
{
    /**
     * @var SimCardRepositoryContract
     */
    private $repository;

    public function __construct(SimCardRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $s_id = new SimCardId($value);
                $this->repository->delete($s_id);
            }

        }else{

            $s_id = new SimCardId($id);
            $this->repository->delete($s_id);

        }

    }
}
